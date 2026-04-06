@extends('layouts.app')
@section('title','Pengguna - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center justify-between">
      <h2 class="text-lg font-semibold text-gray-900">Manajemen Pengguna</h2>
      <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-800">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Pengguna
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="bg-white rounded-xl border border-gray-200 p-4 mb-4">
        <form method="GET" class="flex gap-3">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="flex-1 border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          <select name="role" class="border border-gray-200 rounded-lg px-3 py-2 text-sm focus:outline-none">
            <option value="">Semua Role</option>
            <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
            <option value="staff" {{ request('role')=='staff'?'selected':'' }}>Staff</option>
            <option value="user" {{ request('role')=='user'?'selected':'' }}>User</option>
          </select>
          <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium">Filter</button>
        </form>
      </div>
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-gray-50 text-xs font-semibold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Pengguna</th>
            <th class="text-left px-6 py-3">Role</th>
            <th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Bergabung</th>
            <th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($users as $user)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3">
                <div class="flex items-center gap-3">
                  <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-700 text-xs font-bold">{{ substr($user->name,0,1) }}</div>
                  <div><p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p><p class="text-xs text-gray-400">{{ $user->email }}</p></div>
                </div>
              </td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $user->role=='admin'?'bg-purple-50 text-purple-700':($user->role=='staff'?'bg-blue-50 text-blue-700':'bg-gray-100 text-gray-600') }}">{{ ucfirst($user->role) }}</span></td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $user->is_active?'bg-emerald-50 text-emerald-700':'bg-red-50 text-red-700' }}">{{ $user->is_active?'Aktif':'Nonaktif' }}</span></td>
              <td class="px-6 py-3 text-xs text-gray-400">{{ $user->created_at->format('d M Y') }}</td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="{{ route('admin.users.edit',$user) }}" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="{{ route('admin.users.toggle',$user) }}">@csrf @method('PATCH')
                  <button class="text-xs px-2 py-1 border border-amber-200 text-amber-600 rounded-lg hover:bg-amber-50">{{ $user->is_active?'Nonaktifkan':'Aktifkan' }}</button>
                </form>
                @if($user->id !== auth()->id())
                <form method="POST" action="{{ route('admin.users.destroy',$user) }}" onsubmit="return confirm('Hapus pengguna?')">@csrf @method('DELETE')
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Hapus</button>
                </form>
                @endif
              </td>
            </tr>
            @empty<tr><td colspan="5" class="text-center py-12 text-gray-400">Tidak ada pengguna.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $users->withQueryString()->links() }}</div>
      </div>
    </main>
  </div>
</div>
@endsection
