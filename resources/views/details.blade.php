@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-gray-100 py-6 border-b border-gray-200">
    <div class="container mx-auto px-4 text-xs text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
        <span class="mx-2">/</span>
        <a href="{{ route('shop') }}" class="hover:text-primary">Shop</a>
        <span class="mx-2">/</span>
        @if($product->category)
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-primary">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
        @endif
        <span class="text-gray-800 font-semibold">{{ $product->name }}</span>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    <div class="flex flex-col lg:flex-row gap-12 bg-white p-8 rounded-2xl border border-gray-100 shadow-sm">
        {{-- Product Image --}}
        <div class="w-full lg:w-1/2">
            <div class="bg-gray-50 rounded-xl p-8 flex items-center justify-center border border-gray-100 mb-4 h-[400px]">
                <img id="main-product-img" src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain drop-shadow-md" />
            </div>
        </div>

        {{-- Product Info & Add to Cart --}}
        <div class="w-full lg:w-1/2 flex flex-col justify-between">
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <span class="text-xs font-bold uppercase tracking-widest text-primary bg-primary/10 px-2.5 py-0.5 rounded">
                        {{ $product->category?->name ?? 'Furniture' }}
                    </span>
                    @if($product->brand)
                        <span class="text-xs text-gray-400 font-medium">by {{ $product->brand->name }}</span>
                    @endif
                </div>

                <h1 class="text-2xl lg:text-3xl font-black text-gray-900 leading-tight">
                    {{ $product->name }}
                </h1>

                <div class="flex items-center space-x-4">
                    @if($product->sale_price && $product->sale_price > 0)
                        <span class="text-3xl font-black text-primary">
                            Rp {{ number_format($product->sale_price, 0, ',', '.') }}
                        </span>
                        <span class="text-lg text-gray-400 line-through">
                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                        </span>
                        <span class="bg-rose-500 text-white text-xs font-bold px-2 py-0.5 rounded uppercase">
                            Hemat Rp {{ number_format($product->regular_price - $product->sale_price, 0, ',', '.') }}
                        </span>
                    @else
                        <span class="text-3xl font-black text-gray-900">
                            Rp {{ number_format($product->regular_price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                <p class="text-sm text-gray-600 leading-relaxed pt-2">
                    {{ $product->short_description ?: $product->description }}
                </p>

                <div class="space-y-1.5 pt-3 text-xs text-gray-500 border-t border-gray-100">
                    <div><span class="font-bold text-gray-700">SKU:</span> {{ $product->SKU }}</div>
                    <div>
                        <span class="font-bold text-gray-700">Ketersediaan:</span>
                        @if($product->stock_status === 'instock')
                            <span class="text-emerald-600 font-semibold"><i class="fa-solid fa-circle-check"></i> Siap Kirim (Stok: {{ $product->quantity }})</span>
                        @else
                            <span class="text-rose-500 font-semibold"><i class="fa-solid fa-circle-xmark"></i> Stok Habis</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Quantity & Add to Cart Form --}}
            <form action="{{ route('cart.add') }}" method="POST" class="mt-8 pt-6 border-t border-gray-100 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}" />

                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden w-36 h-12">
                    <button type="button" onclick="updateQty(-1)" class="w-10 h-full bg-gray-50 hover:bg-gray-100 text-gray-600 flex items-center justify-center font-bold text-sm">
                        -
                    </button>
                    <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product->quantity }}" class="w-16 h-full text-center outline-none text-sm font-semibold text-gray-800" />
                    <button type="button" onclick="updateQty(1)" class="w-10 h-full bg-gray-50 hover:bg-gray-100 text-gray-600 flex items-center justify-center font-bold text-sm">
                        +
                    </button>
                </div>

                <button type="submit" class="flex-grow h-12 bg-primary hover:bg-secondary text-white font-bold text-sm rounded-lg shadow-md hover:shadow-lg transition duration-200 flex items-center justify-center space-x-2">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Tambah ke Keranjang</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Description & Details Tabs --}}
    <div class="mt-12 bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
        <h3 class="text-lg font-bold text-gray-900 uppercase tracking-wider mb-4 pb-2 border-b">
            Deskripsi Produk Lengkap
        </h3>
        <div class="prose max-w-none text-sm text-gray-600 leading-relaxed space-y-4">
            <p>{{ $product->description }}</p>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
        <div class="mt-16">
            <h3 class="text-xl font-bold text-gray-900 uppercase tracking-tight mb-8">
                Produk Terkait
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $related)
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition duration-300 overflow-hidden flex flex-col justify-between group">
                        <div class="relative bg-gray-50 p-6 flex items-center justify-center h-52 overflow-hidden">
                            <img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="max-h-full object-contain group-hover:scale-105 transition duration-300" />
                        </div>
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <h4 class="font-bold text-gray-900 text-xs hover:text-primary transition line-clamp-1 mb-2">
                                <a href="{{ route('product.details', $related->slug) }}">{{ $related->name }}</a>
                            </h4>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-black text-gray-900">
                                    Rp {{ number_format($related->sale_price ?: $related->regular_price, 0, ',', '.') }}
                                </span>
                                <a href="{{ route('product.details', $related->slug) }}" class="text-xs text-primary font-semibold hover:underline">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    function updateQty(delta) {
        const input = document.getElementById('qty-input');
        if (!input) return;
        let current = parseInt(input.value) || 1;
        let next = current + delta;
        if (next < 1) next = 1;
        input.value = next;
    }
</script>
@endpush
