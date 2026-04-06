@extends('layouts.app')
@section('title','Backup & Restore - Admin')
@section('content')
<div class="flex h-screen bg-gray-50 overflow-hidden">
    @include('partials.admin-sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
        {{-- Header --}}
        <header class="bg-white border-b border-gray-200 px-8 h-16 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-1 text-gray-400 hover:text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Settings
                </a>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold text-gray-900">Backup & Restore</span>
            </div>
            <div class="flex items-center gap-3">
                <input type="text" placeholder="Search backups..." class="border border-gray-200 rounded-lg px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 w-48">
                <div class="w-8 h-8 bg-gray-200 rounded-full"></div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            @include('partials.alert')

            {{-- Page Heading --}}
            <div class="flex items-start justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Backup & Restore</h1>
                    <p class="text-gray-500 mt-1">Safeguard your e-commerce data. Manage snapshots and disaster recovery points.</p>
                </div>
                <form method="POST" action="{{ route('admin.backup.create') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-2 bg-gray-900 text-white px-5 py-3 rounded-xl font-semibold text-sm hover:bg-gray-800 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        Backup Database Now
                    </button>
                </form>
            </div>

            {{-- Stats Grid --}}
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                        <p class="text-sm text-gray-500 font-medium">Total Backups</p>
                    </div>
                    <p class="text-4xl font-bold text-gray-900">{{ $stats['total_backups'] }}</p>
                    <p class="text-xs text-gray-400 mt-2">Storage Capacity: {{ $stats['storage_capacity'] }}</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                        <p class="text-sm text-gray-500 font-medium">Storage Used</p>
                    </div>
                    <p class="text-4xl font-bold text-gray-900">{{ $stats['storage_used'] }}</p>
                    <p class="text-xs text-gray-400 mt-2">Daily growth: {{ $stats['daily_growth'] }}</p>
                </div>
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-gray-500 font-medium">Next Scheduled</p>
                    </div>
                    <p class="text-4xl font-bold text-gray-900">{{ $stats['next_scheduled'] }}</p>
                    <div class="flex items-center gap-1.5 mt-2">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full"></span>
                        <p class="text-xs text-gray-400">Automatic Daily</p>
                    </div>
                </div>
            </div>

            {{-- Backup History Table --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mb-8">
                <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-lg font-bold text-gray-900">Backup History</h2>
                    <div class="flex gap-2">
                        <button class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </button>
                        <button class="p-2 text-gray-400 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        </button>
                    </div>
                </div>

                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200">
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Timestamp</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Backup Name</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">File Size</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($backups as $backup)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-900">{{ $backup['date'] }}</p>
                                <p class="text-xs text-gray-400">{{ $backup['time'] }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-700 font-mono">{{ $backup['name'] }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $backup['size'] }}</td>
                            <td class="px-6 py-4">
                                @if($backup['status'] === 'successful')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Successful
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-red-50 text-red-700 rounded-full text-xs font-medium">
                                        <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span> Failed
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($backup['status'] === 'successful')
                                    <form method="POST" action="{{ route('admin.backup.restore', $backup['file']) }}">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-1.5 px-3 py-1.5 border border-gray-200 rounded-lg text-xs font-medium text-gray-600 hover:bg-gray-50 transition-colors">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                            Restore
                                        </button>
                                    </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.backup.destroy', $backup['file']) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors"
                                                onclick="return confirm('Hapus backup ini?')">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                Belum ada file backup. Klik <strong>Backup Database Now</strong> untuk membuat backup pertama.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-gray-200">
                    <p class="text-sm text-gray-500">Showing 1 to {{ count($backups) }} of 128 entries</p>
                </div>
            </div>

            {{-- Automated Cloud Sync --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                            <h3 class="font-bold text-gray-900">Automated Cloud Sync</h3>
                        </div>
                        <p class="text-sm text-gray-500 max-w-xl">Enable real-time syncing to Amazon S3 or Google Cloud Storage for off-site disaster recovery.</p>
                        <div class="mt-3">
                            <div class="w-32 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-emerald-500 rounded-full" style="width:65%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Status: <span class="text-emerald-600 font-medium">Active</span></p>
                        </div>
                    </div>
                    <button class="px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors flex-shrink-0">
                        Configure Storage
                    </button>
                </div>
            </div>
        </main>

        <footer class="bg-white border-t border-gray-200 px-8 py-3 flex-shrink-0">
            <p class="text-xs text-gray-400">© 2024 Admin System v4.12.0 · <a href="#" class="hover:underline">API Documentation</a> · <a href="#" class="hover:underline">Support</a> · System Status: <span class="text-emerald-600">Operational</span></p>
        </footer>
    </div>
</div>
@endsection
