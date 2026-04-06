@extends('layouts.app')
@section('title', 'Detail Pesanan - Admin')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.admin-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold">Detail Pesanan {{ $order->order_number }}</h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Item Pesanan</h3>
            <table class="w-full text-sm">
              <thead><tr class="text-xs text-gray-500 uppercase border-b"><th class="text-left pb-2">Produk</th><th class="text-right pb-2">Harga</th><th class="text-right pb-2">Qty</th><th class="text-right pb-2">Subtotal</th></tr></thead>
              <tbody>
                @foreach($order->items as $item)
                <tr class="border-b border-gray-50 py-2">
                  <td class="py-2">{{ $item->product_name }}</td>
                  <td class="text-right py-2">{{ \App\Helpers\CurrencyHelper::rupiah($item->price) }}</td>
                  <td class="text-right py-2">{{ $item->qty }}</td>
                  <td class="text-right py-2 font-semibold">{{ \App\Helpers\CurrencyHelper::rupiah($item->subtotal) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <div class="mt-4 space-y-1 text-sm text-right">
              <div class="flex justify-end gap-8"><span class="text-gray-500">Subtotal</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->subtotal) }}</span></div>
              <div class="flex justify-end gap-8"><span class="text-gray-500">Ongkir</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->shipping_cost) }}</span></div>
              <div class="flex justify-end gap-8"><span class="text-gray-500">Pajak</span><span>{{ \App\Helpers\CurrencyHelper::rupiah($order->tax) }}</span></div>
              <div class="flex justify-end gap-8 font-bold text-base border-t pt-2"><span>Total</span><span>{{ $order->total_formatted }}</span></div>
            </div>
          </div>
          @if($order->payment_proof)
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Bukti Pembayaran</h3>
            <img src="{{ Storage::url($order->payment_proof) }}" class="max-w-sm rounded-lg border">
          </div>
          @endif
        </div>
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Update Status</h3>
            <form method="POST" action="{{ route('admin.orders.status',$order) }}">
              @csrf @method('PATCH')
              <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-gray-900">
                @foreach(['pending'=>'Menunggu','paid'=>'Dibayar','confirmed'=>'Dikonfirmasi','shipped'=>'Dikirim','completed'=>'Selesai','cancelled'=>'Dibatalkan'] as $v=>$l)
                <option value="{{ $v }}" {{ $order->status==$v?'selected':'' }}>{{ $l }}</option>
                @endforeach
              </select>
              <button type="submit" class="w-full bg-gray-900 text-white py-2 rounded-lg text-sm font-semibold">Update Status</button>
            </form>
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6 text-sm space-y-3">
            <h3 class="font-semibold">Info Pelanggan</h3>
            <div><p class="text-gray-400 text-xs">Nama</p><p class="font-medium">{{ $order->user->name }}</p></div>
            <div><p class="text-gray-400 text-xs">Email</p><p>{{ $order->user->email }}</p></div>
            <div><p class="text-gray-400 text-xs">Alamat Pengiriman</p><p>{{ $order->shipping_name }}, {{ $order->shipping_address }}, {{ $order->shipping_city }} {{ $order->shipping_postal }}</p></div>
            <div><p class="text-gray-400 text-xs">Metode Bayar</p><p>{{ $order->payment_method }}</p></div>
            <div><p class="text-gray-400 text-xs">Status Bayar</p><span class="text-xs px-2 py-1 rounded-full {{ $order->payment_status=='paid'?'bg-emerald-50 text-emerald-700':'bg-amber-50 text-amber-700' }}">{{ $order->payment_status_label }}</span></div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection
