@extends('layouts.app')

@section('title', 'Daftar Keinginan (Wishlist)')

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-semibold">Wishlist</span>
    </div>
</div>

<div class="container mx-auto px-4 py-16 text-center">
    <div class="max-w-md mx-auto bg-white rounded-2xl border border-gray-200 p-12 shadow-sm">
        <div class="w-16 h-16 bg-rose-50 text-rose-500 rounded-full flex items-center justify-center mx-auto text-2xl mb-4">
            <i class="fa-regular fa-heart"></i>
        </div>
        <h1 class="text-lg font-black text-gray-900 mb-2">Daftar Keinginan Anda Masih Kosong</h1>
        <p class="text-xs text-gray-500 mb-6">Simpan furnitur impian Anda dengan menekan ikon hati pada halaman produk.</p>
        <a href="{{ route('shop') }}" class="inline-block bg-primary hover:bg-secondary text-white font-semibold text-xs px-6 py-2.5 rounded-lg shadow transition">
            Eksplorasi Produk
        </a>
    </div>
</div>
@endsection
