@extends('layouts.app')
@section('title', isset($staff) ? 'Edit Staff' : 'Tambah Staff')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="{{ route('admin.staff.index') }}" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold">{{ isset($staff) ? 'Edit Staff' : 'Tambah Staff Baru' }}</h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="max-w-lg">
        <form method="POST" action="{{ isset($staff) ? route('admin.staff.update',$staff) : route('admin.staff.store') }}" class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
          @csrf @if(isset($staff)) @method('PUT') @endif
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Nama *</label><input type="text" name="name" value="{{ old('name', $staff->name ?? '') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"></div>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Email *</label><input type="email" name="email" value="{{ old('email', $staff->email ?? '') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"></div>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">Password {{ isset($staff)?'(opsional)':'*' }}</label><input type="password" name="password" {{ isset($staff)?'':'required' }} class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900" placeholder="Minimal 8 karakter"></div>
          <div><label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon</label><input type="text" name="phone" value="{{ old('phone', $staff->phone ?? '') }}" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900"></div>
          <div class="flex gap-3">
            <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800">Simpan</button>
            <a href="{{ route('admin.staff.index') }}" class="border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
@endsection
