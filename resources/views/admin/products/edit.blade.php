@extends('layouts.app')
@section('title', isset($product) ? 'Edit Produk' : 'Tambah Produk')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="{{ route('admin.products.index') }}" class="text-gray-500 hover:text-gray-900">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
      </a>
      <h2 class="text-lg font-semibold text-gray-900">{{ isset($product) ? 'Edit Produk' : 'Tambah Produk Baru' }}</h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="max-w-2xl">
        <form method="POST" action="{{ isset($product) ? route('admin.products.update',$product) : route('admin.products.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
          @csrf
          @if(isset($product)) @method('PUT') @endif
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Produk *</label>
            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Harga (Rp) *</label>
              <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" required min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Stok *</label>
              <input type="number" name="stock" value="{{ old('stock', $product->stock ?? '') }}" required min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori *</label>
              <input type="text" name="category" value="{{ old('category', $product->category ?? '') }}" list="categories" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
              <datalist id="categories">@foreach($categories as $c)<option value="{{ $c }}">@endforeach</datalist>
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-1.5">SKU *</label>
              <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" required class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">
            </div>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full border border-gray-200 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900">{{ old('description', $product->description ?? '') }}</textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Gambar Produk</label>
            <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-gray-700">
            @if(isset($product) && $product->image)
              <img src="{{ Storage::url($product->image) }}" class="mt-2 w-24 h-24 object-cover rounded-lg border">
            @endif
          </div>
          @if(isset($product))
          <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" id="is_active" {{ ($product->is_active ?? true) ? 'checked' : '' }} class="rounded accent-gray-900">
            <label for="is_active" class="text-sm font-medium text-gray-700">Produk Aktif</label>
          </div>
          @endif
          <div class="flex gap-3">
            <button type="submit" class="bg-gray-900 text-white px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-800">{{ isset($product) ? 'Simpan Perubahan' : 'Tambah Produk' }}</button>
            <a href="{{ route('admin.products.index') }}" class="border border-gray-200 text-gray-700 px-6 py-2.5 rounded-lg text-sm font-semibold hover:bg-gray-50">Batal</a>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
@endsection
