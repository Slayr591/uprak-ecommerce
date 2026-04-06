<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function rupiah(int|float $amount, bool $showSymbol = true): string
    {
        $formatted = number_format((float) $amount, 0, ',', '.');
        return $showSymbol ? 'Rp ' . $formatted : $formatted;
    }

    public static function parseRupiah(string $value): int
    {
        return (int) str_replace(['Rp', '.', ' '], '', $value);
    }
}
