@extends('layouts.admin')

@section('title', 'Daftar Pesanan Masuk')

@section('content')
<div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center">
        <div>
            <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wider">Semua Pesanan</h2>
            <span class="text-xs text-gray-500">Total {{ $orders->total() }} transaksi tercatat</span>
        </div>
    </div>

    @if($orders->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-gray-50 text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="py-3 px-6">ID Pesanan</th>
                        <th class="py-3 px-6">Pelanggan</th>
                        <th class="py-3 px-6">Alamat</th>
                        <th class="py-3 px-6">Jumlah Item</th>
                        <th class="py-3 px-6">Total Tagihan</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-700">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-50/50">
                            <td class="py-3.5 px-6 font-bold text-gray-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="py-3.5 px-6">
                                <span class="font-semibold text-gray-900 block">{{ $order->name }}</span>
                                <span class="text-gray-400">{{ $order->phone }}</span>
                            </td>
                            <td class="py-3.5 px-6 max-w-xs truncate">{{ $order->city }}, {{ $order->state }}</td>
                            <td class="py-3.5 px-6">{{ $order->orderItems->sum('quantity') }} pcs</td>
                            <td class="py-3.5 px-6 font-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            <td class="py-3.5 px-6">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $order->status === 'delivered' ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800' }}">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="py-3.5 px-6 text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    @else
        <div class="p-16 text-center text-xs text-gray-400">
            <i class="fa-solid fa-receipt text-3xl mb-3 text-gray-300"></i>
            <p>Belum ada riwayat pesanan yang masuk.</p>
        </div>
    @endif
</div>
@endsection
