@extends('layouts.app')
@section('title','Produk - Admin')
@section('content')
<div class="app-viewport">
  <div class="app-canvas">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden bg-[#f7f8fa]">
    <header class="h-16 bg-[#fbfbfc] border-b border-[#dfe3e8] px-8 py-4 flex items-center justify-between">
      <h2 class="text-[44px] font-extrabold tracking-tight text-gray-900">Manajemen Produk</h2>
      <a href="{{ route('admin.products.create') }}" class="btn-dark !h-10">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Produk
      </a>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="ui-card p-4 mb-4 flex gap-3">
        <form method="GET" class="flex-1 flex gap-3">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau SKU..." class="ui-input flex-1">
          <select name="category" class="ui-input !w-[220px]">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)<option value="{{ $cat }}" {{ request('category')==$cat?'selected':'' }}>{{ $cat }}</option>@endforeach
          </select>
          <button type="submit" class="btn-dark !h-10">Cari</button>
        </form>
      </div>
      <div class="ui-card overflow-hidden">
        <table class="w-full">
          <thead><tr class="bg-[#f7f8fa] text-xs font-extrabold text-gray-500 uppercase">
            <th class="text-left px-6 py-3">Produk</th>
            <th class="text-left px-6 py-3">Kategori</th>
            <th class="text-left px-6 py-3">Harga</th>
            <th class="text-left px-6 py-3">Stok</th>
            <th class="text-left px-6 py-3">Status</th>
            <th class="text-left px-6 py-3">Aksi</th>
          </tr></thead>
          <tbody class="divide-y divide-gray-100">
            @forelse($products as $p)
            <tr class="hover:bg-gray-50">
              <td class="px-6 py-3"><p class="text-sm font-semibold text-gray-900">{{ $p->name }}</p><p class="text-xs text-gray-400">{{ $p->sku }}</p></td>
              <td class="px-6 py-3 text-sm text-gray-600">{{ $p->category }}</td>
              <td class="px-6 py-3 text-sm font-semibold text-gray-900">{{ $p->price_formatted }}</td>
              <td class="px-6 py-3">
                @if($p->isOutOfStock())<span class="text-xs px-2 py-1 bg-red-50 text-red-700 rounded-full">Habis</span>
                @elseif($p->isLowStock())<span class="text-xs px-2 py-1 bg-amber-50 text-amber-700 rounded-full">{{ $p->stock }} (Rendah)</span>
                @else<span class="text-sm text-gray-700">{{ $p->stock }}</span>@endif
              </td>
              <td class="px-6 py-3"><span class="text-xs px-2 py-1 rounded-full {{ $p->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-gray-100 text-gray-500' }}">{{ $p->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
              <td class="px-6 py-3 flex items-center gap-2">
                <a href="{{ route('admin.products.edit',$p) }}" class="text-xs px-2 py-1 border border-gray-200 rounded-lg hover:bg-gray-50">Edit</a>
                <form method="POST" action="{{ route('admin.products.destroy',$p) }}" onsubmit="return confirm('Hapus produk ini?')">@csrf @method('DELETE')
                  <button class="text-xs px-2 py-1 border border-red-200 text-red-600 rounded-lg hover:bg-red-50">Hapus</button>
                </form>
              </td>
            </tr>
            @empty<tr><td colspan="6" class="text-center py-12 text-gray-400">Tidak ada produk.</td></tr>
            @endforelse
          </tbody>
        </table>
        <div class="px-6 py-4 border-t">{{ $products->withQueryString()->links() }}</div>
      </div>
    </main>
  </div>
  </div>
</div>
@endsection
