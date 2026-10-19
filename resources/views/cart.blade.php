@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-semibold">Keranjang Belanja</span>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    @if(count($cart) > 0)
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Cart Items Table --}}
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                        <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider">
                            Item Dalam Keranjang ({{ count($cart) }})
                        </h2>
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua keranjang?')">
                            @csrf
                            <button type="submit" class="text-xs text-rose-500 hover:text-rose-700 font-semibold flex items-center space-x-1">
                                <i class="fa-regular fa-trash-can"></i>
                                <span>Kosongkan</span>
                            </button>
                        </form>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach($cart as $id => $item)
                            <div class="p-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                                <div class="flex items-center space-x-4">
                                    <div class="w-20 h-20 bg-gray-50 rounded-xl p-2 border border-gray-100 flex items-center justify-center flex-shrink-0">
                                        <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" class="max-h-full max-w-full object-contain" />
                                    </div>
                                    <div>
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-primary">{{ $item['category'] }}</span>
                                        <h3 class="font-bold text-gray-900 text-sm hover:text-primary">
                                            <a href="{{ route('product.details', $item['slug']) }}">{{ $item['name'] }}</a>
                                        </h3>
                                        <span class="text-xs text-gray-500 block mt-1">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }} / item
                                        </span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between w-full sm:w-auto sm:space-x-6">
                                    {{-- Qty Controls --}}
                                    <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden h-9">
                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}" />
                                            <input type="hidden" name="action" value="decrease" />
                                            <button type="submit" class="w-8 h-full bg-gray-50 hover:bg-gray-100 text-gray-600 flex items-center justify-center font-bold text-xs">-</button>
                                        </form>

                                        <span class="w-10 text-center font-bold text-xs text-gray-800">
                                            {{ $item['quantity'] }}
                                        </span>

                                        <form action="{{ route('cart.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $id }}" />
                                            <input type="hidden" name="action" value="increase" />
                                            <button type="submit" class="w-8 h-full bg-gray-50 hover:bg-gray-100 text-gray-600 flex items-center justify-center font-bold text-xs">+</button>
                                        </form>
                                    </div>

                                    {{-- Subtotal --}}
                                    <div class="text-right min-w-[110px]">
                                        <span class="text-sm font-black text-gray-900">
                                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                        </span>
                                    </div>

                                    {{-- Remove Button --}}
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-400 hover:text-rose-500 transition" title="Hapus Item">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-6">
                    <a href="{{ route('shop') }}" class="inline-flex items-center space-x-2 text-sm font-semibold text-primary hover:text-secondary">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        <span>Lanjut Belanja</span>
                    </a>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-black text-gray-900 uppercase tracking-wider pb-3 border-b">
                        Ringkasan Pesanan
                    </h3>

                    <div class="space-y-2.5 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal Produk</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>PPN (11%)</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span class="text-emerald-600 font-bold">Gratis Ongkir</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-200 flex justify-between items-center">
                        <span class="text-base font-bold text-gray-900">Total Tagihan</span>
                        <span class="text-xl font-black text-primary">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="pt-4">
                        <a href="{{ route('checkout') }}" class="w-full bg-primary hover:bg-secondary text-white font-bold text-sm py-3.5 rounded-xl shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center space-x-2">
                            <span>Lanjut ke Pembayaran</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-200 p-16 text-center max-w-lg mx-auto shadow-sm">
            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-300 text-3xl mb-4">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <h2 class="text-xl font-black text-gray-900 mb-2">Keranjang Anda Masih Kosong</h2>
            <p class="text-xs text-gray-500 mb-6">Jelajahi koleksi furnitur dan pencahayaan kami sekarang.</p>
            <a href="{{ route('shop') }}" class="inline-block bg-primary hover:bg-secondary text-white font-semibold text-xs px-6 py-3 rounded-lg shadow transition">
                Mulai Berbelanja
            </a>
        </div>
    @endif
</div>
@endsection
