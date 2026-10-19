@extends('layouts.app')

@section('title', 'Katalog Produk')

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 flex items-center justify-between text-xs text-gray-500">
        <div>
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span class="mx-2">/</span>
            <span class="text-gray-800 font-semibold">Shop</span>
        </div>
        <div>
            Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        {{-- Sidebar Filters --}}
        <aside class="w-full lg:w-1/4 space-y-8">
            {{-- Search Filter --}}
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-sm uppercase tracking-wider text-gray-800 mb-4 pb-2 border-b">
                    Cari Produk
                </h4>
                <form action="{{ route('shop') }}" method="GET" class="relative">
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('brand')) <input type="hidden" name="brand" value="{{ request('brand') }}"> @endif
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Kata kunci..." class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm outline-none focus:border-primary pr-9" />
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-primary">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </button>
                </form>
            </div>

            {{-- Categories Filter --}}
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <h4 class="font-bold text-sm uppercase tracking-wider text-gray-800">
                        Kategori
                    </h4>
                    @if(request('category'))
                        <a href="{{ route('shop', request()->except('category')) }}" class="text-[11px] text-rose-500 hover:underline">Reset</a>
                    @endif
                </div>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('shop', request()->except('category')) }}" class="flex justify-between items-center py-1 {{ !request('category') ? 'text-primary font-bold' : 'text-gray-600 hover:text-primary' }}">
                            <span>Semua Kategori</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('shop', array_merge(request()->query(), ['category' => $category->slug])) }}" class="flex justify-between items-center py-1 {{ request('category') == $category->slug ? 'text-primary font-bold' : 'text-gray-600 hover:text-primary' }}">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $category->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- Brands Filter --}}
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                <div class="flex justify-between items-center mb-4 pb-2 border-b">
                    <h4 class="font-bold text-sm uppercase tracking-wider text-gray-800">
                        Merek
                    </h4>
                    @if(request('brand'))
                        <a href="{{ route('shop', request()->except('brand')) }}" class="text-[11px] text-rose-500 hover:underline">Reset</a>
                    @endif
                </div>
                <ul class="space-y-2 text-sm">
                    @foreach($brands as $brand)
                        <li>
                            <a href="{{ route('shop', array_merge(request()->query(), ['brand' => $brand->slug])) }}" class="flex justify-between items-center py-1 {{ request('brand') == $brand->slug ? 'text-primary font-bold' : 'text-gray-600 hover:text-primary' }}">
                                <span>{{ $brand->name }}</span>
                                <span class="text-xs bg-gray-100 text-gray-500 px-2 py-0.5 rounded-full">{{ $brand->products_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        {{-- Products Grid & Header --}}
        <main class="w-full lg:w-3/4">
            {{-- Top Sort Bar --}}
            <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm mb-6 flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-xs text-gray-500">
                    Menampilkan <span class="font-bold text-gray-800">{{ $products->count() }}</span> produk di halaman ini
                </div>

                <form method="GET" action="{{ route('shop') }}" class="flex items-center space-x-2">
                    @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
                    @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
                    @if(request('brand')) <input type="hidden" name="brand" value="{{ request('brand') }}"> @endif

                    <label for="sort" class="text-xs text-gray-500 font-medium">Urutkan:</label>
                    <select name="sort" id="sort" onchange="this.form.submit()" class="border border-gray-200 rounded-lg px-3 py-1.5 text-xs text-gray-700 outline-none focus:border-primary">
                        <option value="default" {{ request('sort') == 'default' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga: Termurah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga: Termahal</option>
                    </select>
                </form>
            </div>

            {{-- Products List --}}
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
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
                                    <p class="text-xs text-gray-500 line-clamp-2 mb-3">
                                        {{ $product->short_description }}
                                    </p>
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

                {{-- Pagination Links --}}
                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <i class="fa-solid fa-box-open text-4xl text-gray-300 mb-3"></i>
                    <h3 class="text-base font-bold text-gray-800 mb-1">Produk Tidak Ditemukan</h3>
                    <p class="text-xs text-gray-500 mb-4">Coba sesuaikan kata kunci atau filter kategori Anda.</p>
                    <a href="{{ route('shop') }}" class="inline-block bg-primary text-white text-xs font-semibold px-4 py-2 rounded-lg hover:bg-secondary transition">
                        Reset Semua Filter
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection
