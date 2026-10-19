@extends('layouts.app')

@section('title', 'Pembayaran (Checkout)')

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('cart') }}" class="hover:text-primary">Cart</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-semibold">Checkout</span>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="flex flex-col lg:flex-row gap-8">
            {{-- Billing Form --}}
            <div class="w-full lg:w-2/3">
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm space-y-6">
                    <h2 class="text-lg font-black text-gray-900 uppercase tracking-wider pb-3 border-b">
                        Informasi Pengiriman & Kontak
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nama Lengkap *</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Contoh: Allam Permata" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary" />
                            @error('name') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Nomor WhatsApp / HP *</label>
                            <input type="text" name="phone" required value="{{ old('phone') }}" placeholder="Contoh: 08123456789" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary" />
                            @error('phone') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Alamat Lengkap *</label>
                        <textarea name="address" required rows="3" placeholder="Nama jalan, nomor rumah, RT/RW, patokan..." class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary">{{ old('address') }}</textarea>
                        @error('address') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kota / Kabupaten *</label>
                            <input type="text" name="city" required value="{{ old('city') }}" placeholder="Jakarta Selatan" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary" />
                            @error('city') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Provinsi *</label>
                            <input type="text" name="state" required value="{{ old('state') }}" placeholder="DKI Jakarta" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary" />
                            @error('state') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Kode Pos *</label>
                            <input type="text" name="zip" required value="{{ old('zip') }}" placeholder="12345" class="w-full border border-gray-200 rounded-lg px-3.5 py-2.5 text-sm outline-none focus:border-primary" />
                            @error('zip') <span class="text-xs text-rose-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm space-y-4">
                    <h3 class="text-base font-black text-gray-900 uppercase tracking-wider pb-3 border-b">
                        Pesanan Anda
                    </h3>

                    <div class="max-h-60 overflow-y-auto divide-y divide-gray-100 pr-1">
                        @foreach($cart as $item)
                            <div class="py-2.5 flex justify-between items-center text-xs">
                                <div>
                                    <span class="font-bold text-gray-800">{{ $item['name'] }}</span>
                                    <span class="text-gray-400 block">x {{ $item['quantity'] }}</span>
                                </div>
                                <span class="font-bold text-gray-900">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-2 text-xs text-gray-600 pt-3 border-t border-gray-100">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>PPN (11%)</span>
                            <span class="font-bold text-gray-900">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Ongkos Kirim</span>
                            <span class="text-emerald-600 font-bold">Gratis</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-200 flex justify-between items-center">
                        <span class="text-sm font-bold text-gray-900">Total Tagihan</span>
                        <span class="text-lg font-black text-primary">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="w-full mt-4 bg-primary hover:bg-secondary text-white font-bold text-sm py-3.5 rounded-xl shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-lock text-xs"></i>
                        <span>Konfirmasi & Buat Pesanan</span>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
