@extends('layouts.app')
@section('title','Detail Pembayaran - Staff')
@section('content')
<div class="flex h-screen bg-gray-50">
  @include('partials.staff-sidebar')
  <div class="flex-1 flex flex-col overflow-hidden">
    <header class="bg-white border-b border-gray-200 px-8 py-4 flex items-center gap-3">
      <a href="{{ route('staff.payments.index') }}" class="text-gray-500 hover:text-gray-900"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></a>
      <h2 class="text-lg font-semibold">Detail Pembayaran {{ $order->order_number }}</h2>
    </header>
    <main class="flex-1 overflow-y-auto p-8">
      @include('partials.alert')
      <div class="grid grid-cols-2 gap-6">
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Info Pelanggan</h3>
            <div class="space-y-2 text-sm">
              <div class="flex gap-4"><span class="text-gray-400 w-28">Nama</span><span class="font-medium">{{ $order->user->name }}</span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Email</span><span>{{ $order->user->email }}</span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">No. Order</span><span class="font-medium">{{ $order->order_number }}</span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Total</span><span class="font-bold text-lg">{{ $order->total_formatted }}</span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Metode Bayar</span><span>{{ $order->payment_method }}</span></div>
              <div class="flex gap-4"><span class="text-gray-400 w-28">Tanggal</span><span>{{ $order->created_at->format('d M Y, H:i') }}</span></div>
            </div>
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-3">Item Pesanan</h3>
            @foreach($order->items as $item)
            <div class="flex justify-between text-sm py-2 border-b border-gray-50 last:border-0">
              <span>{{ $item->product_name }} x{{ $item->qty }}</span>
              <span class="font-semibold">{{ \App\Helpers\CurrencyHelper::rupiah($item->subtotal) }}</span>
            </div>
            @endforeach
          </div>
        </div>
        <div class="space-y-6">
          <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="font-semibold mb-4">Bukti Pembayaran</h3>
            @if($order->payment_proof)
              <img src="{{ Storage::url($order->payment_proof) }}" class="w-full rounded-xl border object-contain max-h-96">
            @else
              <div class="border-2 border-dashed border-gray-200 rounded-xl p-10 text-center text-gray-400">Belum ada bukti pembayaran</div>
            @endif
          </div>
          <div class="bg-white rounded-xl border border-gray-200 p-6 flex gap-3">
            <form method="POST" action="{{ route('staff.payments.confirm',$order) }}" class="flex-1">@csrf @method('PATCH')
              <button class="w-full bg-emerald-600 text-white py-3 rounded-xl font-semibold hover:bg-emerald-700">✓ Konfirmasi Pembayaran</button>
            </form>
            <form method="POST" action="{{ route('staff.payments.reject',$order) }}" class="flex-1">@csrf @method('PATCH')
              <button class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600">✕ Tolak</button>
            </form>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
@endsection
