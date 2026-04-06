<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use RuntimeException;
use SplFileInfo;
use Throwable;

class BackupController extends Controller
{
    private const BACKUP_DIRECTORY = 'app/backups';
    private const STORAGE_CAPACITY_BYTES = 5_368_709_120; // 5 GB (untuk indikator UI)

    public function index()
    {
        $backups = $this->getBackups();
        $usedStorageBytes = $backups->sum('size_bytes');
        $capacityPercent = self::STORAGE_CAPACITY_BYTES > 0
            ? min(100, (int) round(($usedStorageBytes / self::STORAGE_CAPACITY_BYTES) * 100))
            : 0;

        $stats = [
            'total_backups'    => $backups->count(),
            'storage_used'     => $this->formatBytes($usedStorageBytes),
            'storage_capacity' => $capacityPercent . '%',
            'next_scheduled'   => '-',
            'daily_growth'     => '-',
        ];

        return view('admin.backup.index', compact('backups', 'stats'));
    }

    public function create()
    {
        try {
            $this->ensureBackupDirectory();

            $fileName = 'db_backup_' . now()->format('Ymd_His') . '.sql';
            $fullPath = $this->backupPath($fileName);
            File::put($fullPath, $this->buildSqlDump());

            $size = File::size($fullPath) ?: 0;

            return redirect()->route('admin.backup.index')
                ->with('success', "Backup database berhasil dibuat: {$fileName} ({$this->formatBytes($size)})");
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', 'Gagal membuat backup: ' . $e->getMessage());
        }
    }

    public function restore(string $file)
    {
        $fullPath = $this->resolveBackupPath($file);

        if (!$fullPath || !File::exists($fullPath)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }

        try {
            $sql = File::get($fullPath);

            if (trim($sql) === '') {
                throw new RuntimeException('Isi file backup kosong.');
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $this->executeSqlDump($sql);
            DB::statement('SET FOREIGN_KEY_CHECKS=1');

            return back()->with('success', 'Restore backup ' . basename($file) . ' berhasil dijalankan.');
        } catch (Throwable $e) {
            report($e);

            try {
                DB::statement('SET FOREIGN_KEY_CHECKS=1');
            } catch (Throwable $unused) {
                // noop
            }

            return back()->with('error', 'Restore gagal: ' . $e->getMessage());
        }
    }

    public function destroy(string $file)
    {
        $fullPath = $this->resolveBackupPath($file);

        if (!$fullPath || !File::exists($fullPath)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }

        try {
            File::delete($fullPath);

            return back()->with('success', 'Backup ' . basename($file) . ' berhasil dihapus.');
        } catch (Throwable $e) {
            report($e);

            return back()->with('error', 'Gagal menghapus backup: ' . $e->getMessage());
        }
    }

    private function getBackups(): Collection
    {
        $this->ensureBackupDirectory();

        return collect(File::files($this->backupDirectory()))
            ->filter(fn (SplFileInfo $file) => strtolower($file->getExtension()) === 'sql')
            ->sortByDesc(fn (SplFileInfo $file) => $file->getMTime())
            ->values()
            ->map(function (SplFileInfo $file, int $index) {
                $timestamp = $file->getMTime();
                $sizeBytes = $file->getSize();

                return [
                    'id'         => $index + 1,
                    'file'       => $file->getFilename(),
                    'name'       => $file->getFilename(),
                    'size'       => $this->formatBytes($sizeBytes),
                    'size_bytes' => $sizeBytes,
                    'date'       => date('d M Y', $timestamp),
                    'time'       => date('H:i:s', $timestamp),
                    'status'     => 'successful',
                ];
            });
    }

    private function buildSqlDump(): string
    {
        $database = DB::connection()->getDatabaseName();
        $tableRows = DB::select('SHOW TABLES');

        if (empty($tableRows)) {
            throw new RuntimeException('Tidak ada tabel yang bisa di-backup.');
        }

        $dump = [];
        $dump[] = '-- Database backup generated at ' . now()->format('Y-m-d H:i:s');
        $dump[] = '-- Source database: ' . $database;
        $dump[] = 'SET FOREIGN_KEY_CHECKS=0;';
        $dump[] = '';

        foreach ($tableRows as $tableRow) {
            $table = (string) array_values((array) $tableRow)[0];

            if ($table === '') {
                continue;
            }

            $wrappedTable = $this->wrapIdentifier($table);
            $createTableRow = DB::selectOne("SHOW CREATE TABLE {$wrappedTable}");

            if (!$createTableRow) {
                throw new RuntimeException("Gagal membaca struktur tabel {$table}.");
            }

            $createData = (array) $createTableRow;
            $createSql = $createData['Create Table'] ?? array_values($createData)[1] ?? null;

            if (!$createSql) {
                throw new RuntimeException("Gagal membangun query CREATE TABLE untuk {$table}.");
            }

            $dump[] = "DROP TABLE IF EXISTS {$wrappedTable};";
            $dump[] = $createSql . ';';

            $rows = DB::table($table)->get();

            if ($rows->isNotEmpty()) {
                $columns = array_keys((array) $rows->first());
                $columnList = implode(', ', array_map([$this, 'wrapIdentifier'], $columns));

                foreach ($rows->chunk(200) as $chunk) {
                    $valueSets = $chunk->map(function ($row) {
                        $values = array_map(fn ($value) => $this->toSqlValue($value), (array) $row);

                        return '(' . implode(', ', $values) . ')';
                    })->implode(",\n");

                    $dump[] = "INSERT INTO {$wrappedTable} ({$columnList}) VALUES\n{$valueSets};";
                }
            }

            $dump[] = '';
        }

        $dump[] = 'SET FOREIGN_KEY_CHECKS=1;';

        return implode(PHP_EOL, $dump) . PHP_EOL;
    }

    private function executeSqlDump(string $sql): void
    {
        $length = strlen($sql);
        $statement = '';
        $inSingleQuote = false;
        $inDoubleQuote = false;
        $inLineComment = false;
        $inBlockComment = false;

        for ($i = 0; $i < $length; $i++) {
            $char = $sql[$i];
            $next = $i + 1 < $length ? $sql[$i + 1] : '';
            $prev = $i > 0 ? $sql[$i - 1] : '';

            if ($inLineComment) {
                if ($char === "\n") {
                    $inLineComment = false;
                }
                continue;
            }

            if ($inBlockComment) {
                if ($char === '*' && $next === '/') {
                    $inBlockComment = false;
                    $i++;
                }
                continue;
            }

            if (!$inSingleQuote && !$inDoubleQuote) {
                if ($char === '-' && $next === '-' && ($prev === '' || $prev === "\n" || $prev === "\r")) {
                    $inLineComment = true;
                    $i++;
                    continue;
                }

                if ($char === '#') {
                    $inLineComment = true;
                    continue;
                }

                if ($char === '/' && $next === '*') {
                    $inBlockComment = true;
                    $i++;
                    continue;
                }
            }

            if ($char === "'" && !$inDoubleQuote && !$this->isEscaped($sql, $i)) {
                $inSingleQuote = !$inSingleQuote;
            } elseif ($char === '"' && !$inSingleQuote && !$this->isEscaped($sql, $i)) {
                $inDoubleQuote = !$inDoubleQuote;
            }

            if ($char === ';' && !$inSingleQuote && !$inDoubleQuote) {
                $trimmed = trim($statement);

                if ($trimmed !== '') {
                    DB::unprepared($trimmed);
                }

                $statement = '';
                continue;
            }

            $statement .= $char;
        }

        $trimmed = trim($statement);
        if ($trimmed !== '') {
            DB::unprepared($trimmed);
        }
    }

    private function isEscaped(string $sql, int $position): bool
    {
        $backslashCount = 0;
        $cursor = $position - 1;

        while ($cursor >= 0 && $sql[$cursor] === '\\') {
            $backslashCount++;
            $cursor--;
        }

        return $backslashCount % 2 === 1;
    }

    private function toSqlValue(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        if ($value instanceof \DateTimeInterface) {
            return $this->quote($value->format('Y-m-d H:i:s'));
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return $this->quote((string) $value);
    }

    private function quote(string $value): string
    {
        $quoted = DB::getPdo()->quote($value);

        if ($quoted !== false) {
            return $quoted;
        }

        return "'" . str_replace(['\\', "'"], ['\\\\', "\\'"], $value) . "'";
    }

    private function wrapIdentifier(string $identifier): string
    {
        return '`' . str_replace('`', '``', $identifier) . '`';
    }

    private function resolveBackupPath(string $file): ?string
    {
        $safeFileName = basename($file);

        if ($safeFileName !== $file) {
            return null;
        }

        if (!preg_match('/^[A-Za-z0-9._-]+\.sql$/', $safeFileName)) {
            return null;
        }

        return $this->backupPath($safeFileName);
    }

    private function backupPath(string $fileName): string
    {
        return $this->backupDirectory() . DIRECTORY_SEPARATOR . $fileName;
    }

    private function backupDirectory(): string
    {
        return storage_path(self::BACKUP_DIRECTORY);
    }

    private function ensureBackupDirectory(): void
    {
        if (!File::exists($this->backupDirectory())) {
            File::makeDirectory($this->backupDirectory(), 0755, true);
        }
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $power = (int) floor(log($bytes, 1024));
        $power = min($power, count($units) - 1);
        $normalized = $bytes / (1024 ** $power);

        return number_format($normalized, $power === 0 ? 0 : 2) . ' ' . $units[$power];
    }
}
