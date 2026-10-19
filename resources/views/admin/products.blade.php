@extends('layouts.admin')

@section('title', 'Katalog Produk Toko')

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Daftar Produk</h2>
            <span class="text-xs text-gray-500">Total {{ $products->total() }} produk terdaftar</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="py-3 px-6">Foto</th>
                    <th class="py-3 px-6">Nama Produk</th>
                    <th class="py-3 px-6">Kategori</th>
                    <th class="py-3 px-6">Merek</th>
                    <th class="py-3 px-6">Harga</th>
                    <th class="py-3 px-6">Stok</th>
                    <th class="py-3 px-6">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach($products as $product)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-3 px-6">
                            <div class="w-12 h-12 bg-gray-50 rounded-lg p-1 border border-gray-100 flex items-center justify-center">
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="max-h-full max-w-full object-contain" />
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            <strong class="text-gray-900 block font-semibold">{{ $product->name }}</strong>
                            <span class="text-[10px] text-gray-400 font-mono">{{ $product->SKU }}</span>
                        </td>
                        <td class="py-3 px-6">{{ $product->category?->name ?? '-' }}</td>
                        <td class="py-3 px-6">{{ $product->brand?->name ?? '-' }}</td>
                        <td class="py-3 px-6 font-bold text-gray-900">
                            Rp {{ number_format($product->sale_price ?: $product->regular_price, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-6">{{ $product->quantity }} unit</td>
                        <td class="py-3 px-6">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase {{ $product->stock_status === 'instock' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                {{ $product->stock_status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-gray-100">
        {{ $products->links() }}
    </div>
</div>
@endsection
