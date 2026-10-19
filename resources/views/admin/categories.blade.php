@extends('layouts.admin')

@section('title', 'Kategori Produk')

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Daftar Kategori</h2>
            <span class="text-xs text-gray-500">Kelola kategori furnitur dan dekorasi</span>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="py-3 px-6">Foto</th>
                    <th class="py-3 px-6">Nama Kategori</th>
                    <th class="py-3 px-6">Slug URL</th>
                    <th class="py-3 px-6">Jumlah Produk</th>
                    <th class="py-3 px-6">Status Populer</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @foreach($categories as $category)
                    <tr class="hover:bg-gray-50/50">
                        <td class="py-3 px-6">
                            <div class="w-10 h-10 bg-gray-50 rounded-lg p-1 border border-gray-100 flex items-center justify-center">
                                <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="max-h-full max-w-full object-contain" />
                            </div>
                        </td>
                        <td class="py-3 px-6 font-semibold text-gray-900">{{ $category->name }}</td>
                        <td class="py-3 px-6 font-mono text-gray-400">{{ $category->slug }}</td>
                        <td class="py-3 px-6 font-bold text-primary">{{ $category->products_count }} item</td>
                        <td class="py-3 px-6">
                            @if($category->is_popular)
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Populer</span>
                            @else
                                <span class="bg-gray-100 text-gray-500 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Reguler</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="p-6 border-t border-gray-100">
        {{ $categories->links() }}
    </div>
</div>
@endsection
