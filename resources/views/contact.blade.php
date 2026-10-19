@extends('layouts.app')

@section('title', 'Hubungi Kami')

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-semibold">Contact</span>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-2xl border border-gray-200 p-8 shadow-sm grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
            <span class="text-xs font-bold uppercase tracking-widest text-primary">Layanan Pelanggan</span>
            <h1 class="text-2xl font-black text-gray-900 mt-1 mb-4">Kami Siap Membantu Anda</h1>
            <p class="text-xs text-gray-600 leading-relaxed mb-6">
                Punya pertanyaan seputar ukuran furnitur, kustomisasi pesanan, atau konfirmasi pengiriman? Hubungi tim kami kapan saja.
            </p>

            <div class="space-y-4 text-xs text-gray-700">
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div>
                        <strong class="block text-gray-900">Showroom Utama</strong>
                        Jl. Raya Smart City No. 12, Kebayoran Baru, Jakarta Selatan
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <strong class="block text-gray-900">Telepon / WhatsApp</strong>
                        +62 812-3456-7890 (Senin - Sabtu: 09:00 - 18:00 WIB)
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <strong class="block text-gray-900">Email</strong>
                        support@surfside.test
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
            <h2 class="text-sm font-bold uppercase tracking-wider text-gray-800 mb-4">Kirim Pesan</h2>
            <form action="#" method="POST" onsubmit="alert('Pesan Anda terkirim!'); return false;" class="space-y-3 text-xs">
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Nama</label>
                    <input type="text" required placeholder="Nama Anda" class="w-full border border-gray-200 rounded-lg p-2.5 outline-none focus:border-primary" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Email</label>
                    <input type="email" required placeholder="email@contoh.com" class="w-full border border-gray-200 rounded-lg p-2.5 outline-none focus:border-primary" />
                </div>
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">Pesan</label>
                    <textarea required rows="4" placeholder="Tuliskan pertanyaan Anda..." class="w-full border border-gray-200 rounded-lg p-2.5 outline-none focus:border-primary"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-secondary text-white font-semibold py-2.5 rounded-lg transition">
                    Kirim Pesan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
