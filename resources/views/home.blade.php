@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    {{-- Hero Carousel Slider --}}
    @if($slides->count() > 0)
        <section class="relative bg-gray-100 overflow-hidden">
            <div class="swiper main-slider">
                <div class="swiper-wrapper">
                    @foreach($slides as $slide)
                        <div class="swiper-slide py-16 lg:py-24">
                            <div class="container mx-auto px-4 flex flex-col-reverse lg:flex-row items-center justify-between gap-8">
                                <div class="w-full lg:w-1/2 space-y-5 text-center lg:text-left">
                                    @if($slide->tag)
                                        <span class="inline-block bg-primary/10 text-primary px-3 py-1 text-xs font-bold uppercase tracking-widest rounded-full">
                                            {{ $slide->tag }}
                                        </span>
                                    @endif
                                    <h1 class="text-3xl lg:text-5xl font-black text-gray-900 tracking-tight leading-tight">
                                        {{ $slide->title }}
                                    </h1>
                                    <p class="text-gray-600 text-sm lg:text-base max-w-lg mx-auto lg:mx-0">
                                        {{ $slide->subtitle }}
                                    </p>
                                    <div class="pt-2">
                                        <a href="{{ $slide->link ?: route('shop') }}" class="inline-flex items-center space-x-2 bg-primary hover:bg-secondary text-white font-semibold text-sm px-7 py-3.5 rounded-lg shadow-md hover:shadow-lg transition duration-200">
                                            <span>Belanja Sekarang</span>
                                            <i class="fa-solid fa-arrow-right text-xs"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="w-full lg:w-1/2 flex justify-center">
                                    <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" class="max-h-[380px] object-contain drop-shadow-xl" />
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>
    @endif

    {{-- Popular Categories --}}
    @if($categories->count() > 0)
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center mb-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary">Koleksi Pilihan</span>
                    <h2 class="text-2xl lg:text-3xl font-black text-gray-900 uppercase tracking-tight mt-1">
                        Kategori Populer
                    </h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category->slug]) }}" class="group block text-center bg-gray-50 hover:bg-white rounded-xl p-5 border border-transparent hover:border-gray-200 hover:shadow-lg transition-all duration-300">
                            <div class="w-20 h-20 mx-auto rounded-full bg-white shadow-sm flex items-center justify-center p-3 mb-3 group-hover:scale-105 transition-transform duration-300">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="max-h-full max-w-full object-contain" />
                            </div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-800 group-hover:text-primary transition">
                                {{ $category->name }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Featured Products --}}
    @if($featuredProducts->count() > 0)
        <section class="py-16 bg-gray-50 border-y border-gray-100">
            <div class="container mx-auto px-4">
                <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-primary">Rekomendasi</span>
                        <h2 class="text-2xl lg:text-3xl font-black text-gray-900 uppercase tracking-tight mt-1">
                            Produk Unggulan
                        </h2>
                    </div>
                    <a href="{{ route('shop') }}" class="mt-3 sm:mt-0 text-sm font-semibold text-primary hover:text-secondary inline-flex items-center space-x-1">
                        <span>Lihat Semua Produk</span>
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($featuredProducts as $product)
                        <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between group">
                            <div class="relative bg-gray-50 p-6 flex items-center justify-center h-64 overflow-hidden">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full object-contain group-hover:scale-105 transition duration-300" />
                                @if($product->sale_price && $product->sale_price > 0)
                                    <span class="absolute top-3 left-3 bg-rose-500 text-white text-[10px] font-bold px-2 py-0.5 rounded uppercase">
                                        Sale
                                    </span>
                                @endif
                            </div>

                            <div class="p-5 flex-grow flex flex-col justify-between">
                                <div>
                                    <span class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 block mb-1">
                                        {{ $product->category?->name ?? 'Furniture' }}
                                    </span>
                                    <h3 class="font-bold text-gray-900 text-sm hover:text-primary transition line-clamp-2 mb-2">
                                        <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                    </h3>
                                </div>

                                <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                    <div>
                                        @if($product->sale_price && $product->sale_price > 0)
                                            <span class="text-base font-black text-primary block">
                                                Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                                            </span>
                                            <span class="text-xs text-gray-400 line-through">
                                                Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                            </span>
                                        @else
                                            <span class="text-base font-black text-gray-900 block">
                                                Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}" />
                                        <input type="hidden" name="quantity" value="1" />
                                        <button type="submit" class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-primary text-gray-700 hover:text-white flex items-center justify-center transition shadow-sm" title="Tambah ke Keranjang">
                                            <i class="fa-solid fa-cart-plus text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Latest Products --}}
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-primary">Baru Masuk</span>
                <h2 class="text-2xl lg:text-3xl font-black text-gray-900 uppercase tracking-tight mt-1">
                    Produk Terbaru
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($latestProducts as $product)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between group">
                        <div class="relative bg-gray-50 p-6 flex items-center justify-center h-64 overflow-hidden">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full object-contain group-hover:scale-105 transition duration-300" />
                        </div>

                        <div class="p-5 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-[11px] font-semibold uppercase tracking-wider text-gray-400 block mb-1">
                                    {{ $product->category?->name ?? 'Living' }}
                                </span>
                                <h3 class="font-bold text-gray-900 text-sm hover:text-primary transition line-clamp-2 mb-2">
                                    <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
                                </h3>
                            </div>

                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <div>
                                    <span class="text-base font-black text-gray-900 block">
                                        Rp {{ number_format($product->sale_price ?: $product->regular_price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}" />
                                    <input type="hidden" name="quantity" value="1" />
                                    <button type="submit" class="w-9 h-9 rounded-lg bg-gray-100 hover:bg-primary text-gray-700 hover:text-white flex items-center justify-center transition shadow-sm">
                                        <i class="fa-solid fa-cart-plus text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        new Swiper('.main-slider', {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
@endpush
