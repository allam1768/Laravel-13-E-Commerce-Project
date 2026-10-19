@extends('layouts.app')

@section('title', 'Pesanan Diterima')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto bg-white rounded-2xl border border-gray-200 p-8 shadow-sm text-center">
        <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto text-2xl mb-4">
            <i class="fa-solid fa-check"></i>
        </div>

        <h1 class="text-2xl font-black text-gray-900 mb-2">Terima Kasih Atas Pesanan Anda!</h1>
        <p class="text-xs text-gray-500 mb-6">
            Pesanan Anda dengan nomor ID <strong class="text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong> telah berhasil kami terima dan sedang diproses.
        </p>

        <div class="bg-gray-50 rounded-xl p-5 text-left text-xs space-y-2 mb-6 border border-gray-100">
            <div class="flex justify-between">
                <span class="text-gray-500">Penerima:</span>
                <span class="font-bold text-gray-900">{{ $order->name }} ({{ $order->phone }})</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Alamat Pengiriman:</span>
                <span class="font-bold text-gray-900 text-right">{{ $order->address }}, {{ $order->city }}, {{ $order->state }} {{ $order->zip }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Total Pembayaran:</span>
                <span class="font-black text-primary text-sm">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-500">Status:</span>
                <span class="text-amber-600 font-bold uppercase tracking-wider">{{ $order->status }}</span>
            </div>
        </div>

        <div class="border-t border-gray-100 pt-4 text-left">
            <h3 class="font-bold text-xs uppercase tracking-wider text-gray-700 mb-3">Rincian Barang</h3>
            <div class="divide-y divide-gray-100">
                @foreach($order->orderItems as $item)
                    <div class="py-2 flex justify-between items-center text-xs">
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-400 font-semibold">{{ $item->quantity }}x</span>
                            <span class="text-gray-800 font-medium">{{ $item->product?->name ?? 'Produk' }}</span>
                        </div>
                        <span class="font-bold text-gray-900">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-center space-x-4">
            <a href="{{ route('shop') }}" class="bg-primary hover:bg-secondary text-white font-semibold text-xs px-6 py-3 rounded-lg shadow transition">
                Belanja Lagi
            </a>
            <a href="{{ route('home') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold text-xs px-6 py-3 rounded-lg transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection
