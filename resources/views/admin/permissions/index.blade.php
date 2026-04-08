@extends('layouts.app')
@section('title','Role & Permission - Admin')
@section('content')
<div class="app-viewport">
    <div class="app-canvas">
    @include('partials.admin-sidebar')

    <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
        {{-- Header --}}
        <header class="bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 h-16 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-700">Settings</a>
                <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold text-gray-900">Role Management</span>
            </div>
        </header>

        <div class="flex flex-1 overflow-hidden">
            {{-- Left sidebar: pilih role --}}
            <div class="w-64 bg-white border-r border-gray-200 flex flex-col flex-shrink-0">
                <div class="p-6 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gray-900 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900 text-sm">Access Control</p>
                            <p class="text-xs text-gray-400">Manage platform roles</p>
                        </div>
                    </div>
                </div>
                <nav class="p-3 space-y-1">
                    @foreach(['admin' => 'Administrator', 'staff' => 'Staff Member', 'user' => 'Registered User'] as $r => $label)
                     <a href="{{ route('admin.permissions', $r) }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-medium transition-colors
                               {{ $role === $r ? 'bg-green-50 text-green-700 border border-green-200' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ $label }}
                    </a>
                    @endforeach
                </nav>
                {{-- <div class="mt-auto p-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-indigo-600 rounded-full flex items-center justify-center text-white text-xs font-bold">{{ substr(auth()->user()->name,0,1) }}</div>
                        {{-- <div>
                            <p class="text-sm font-semibold text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">Super Admin</p>
                        </div>
                    </div>
                </div>--}}
            </div>

            {{-- Main content --}}
            <div class="flex-1 overflow-y-auto p-8">
                @include('partials.alert')

                {{-- Page Header --}}
                <div class="flex items-start justify-between mb-8">
                    <div>
                        <h1 class="text-[50px] font-extrabold tracking-tight text-gray-900">Admin Permissions</h1>
                        <p class="text-gray-500 mt-1 max-w-xl">Define the scope of actions for the <strong>{{ ucfirst($role) }}</strong> role. These settings apply globally to all users assigned this role.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.permissions', $role) }}" class="btn-outline !h-10">Discard</a>
                        <button form="permission-form" type="submit" class="btn-mint !h-10">Save Changes</button>
                    </div>
                </div>

                {{-- Search --}}
                <div class="relative mb-6">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="Search permissions (e.g. Refunds, Inventory, User management)..."
                           class="ui-input !h-12 pl-12">
                </div>

                {{-- Permission Form --}}
                <form id="permission-form" method="POST" action="{{ route('admin.permissions.update', $role) }}">
                    @csrf @method('PUT')

                    <div class="space-y-8">
                        @foreach($labels as $groupKey => $group)
                        <div>
                            {{-- Group Header --}}
                            <div class="flex items-center gap-2 mb-3">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $group['icon'] }}"/></svg>
                                <h3 class="text-lg font-bold text-gray-900">{{ $group['label'] }}</h3>
                            </div>

                            {{-- Permission Items --}}
                            <div class="ui-card divide-y divide-gray-100 shadow-sm">
                                @foreach($group['permissions'] as $permKey => $perm)
                                <div class="flex items-center justify-between px-6 py-5">
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $perm['label'] }}</p>
                                        <p class="text-sm text-gray-400 mt-0.5">{{ $perm['desc'] }}</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox"
                                               name="permissions[{{ $groupKey }}][{{ $permKey }}]"
                                               value="1"
                                               class="sr-only peer"
                                               {{ ($permissions[$groupKey][$permKey] ?? false) ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer
                                                    peer-checked:after:translate-x-full peer-checked:after:border-white
                                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                                    after:bg-white after:border-gray-300 after:border after:rounded-full
                                                    after:h-5 after:w-5 after:transition-all
                                                    peer-checked:bg-green-500"></div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                </form>

                {{-- Auto-save toast --}}
                @if(session('success'))
                <div class="fixed bottom-6 right-6 bg-white border border-gray-200 rounded-xl shadow-lg px-5 py-3 flex items-center gap-3 text-sm text-gray-700">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    {{ session('success') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
