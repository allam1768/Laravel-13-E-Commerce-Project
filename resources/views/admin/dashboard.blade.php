@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-8">
    {{-- Metric Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Total Pendapatan</span>
                <span class="text-xl font-black text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Total Pesanan</span>
                <span class="text-xl font-black text-gray-900">{{ $totalOrders }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center text-xl">
                <i class="fa-solid fa-receipt"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Katalog Produk</span>
                <span class="text-xl font-black text-gray-900">{{ $totalProducts }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-couch"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider block mb-1">Kategori</span>
                <span class="text-xl font-black text-gray-900">{{ $totalCategories }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-layer-group"></i>
            </div>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Pesanan Terbaru</h2>
            <a href="{{ route('admin.orders') }}" class="text-xs text-primary font-semibold hover:underline">Lihat Semua</a>
        </div>

        @if($recentOrders->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="py-3 px-6">ID Pesanan</th>
                            <th class="py-3 px-6">Nama Pemesan</th>
                            <th class="py-3 px-6">No. Telepon</th>
                            <th class="py-3 px-6">Total</th>
                            <th class="py-3 px-6">Status</th>
                            <th class="py-3 px-6">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-gray-700">
                        @foreach($recentOrders as $order)
                            <tr class="hover:bg-gray-50/50">
                                <td class="py-3.5 px-6 font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="py-3.5 px-6">{{ $order->name }}</td>
                                <td class="py-3.5 px-6">{{ $order->phone }}</td>
                                <td class="py-3.5 px-6 font-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                <td class="py-3.5 px-6">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-6 text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-12 text-center text-xs text-gray-400">
                Belum ada transaksi pesanan masuk.
            </div>
        @endif
    </div>
</div>
@endsection
