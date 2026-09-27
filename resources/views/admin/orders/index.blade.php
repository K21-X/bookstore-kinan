@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Pesanan Masuk (COD)</h1>
            <p class="text-xs text-stone-500 mt-0.5">Kelola konfirmasi status pesanan dan rincian pengiriman buku ke pembeli</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
        <!-- Filter Controls -->
        <div class="p-4 border-b border-stone-200 bg-stone-50/50">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2.5">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari kode order / nama / email..." 
                    class="w-full sm:w-64 px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700" 
                />
                <select name="status" class="w-full sm:w-44 px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid (Terkirim & Lunas)</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                </select>
                <button type="submit" class="px-4 py-1.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl transition-colors">
                    Filter
                </button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                        <th class="py-3 px-6">Kode Order</th>
                        <th class="py-3 px-4">Nama Pembeli</th>
                        <th class="py-3 px-4">Total Tagihan</th>
                        <th class="py-3 px-4">Status Pesanan</th>
                        <th class="py-3 px-4">Waktu Pemesanan</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($orders as $order)
                        <tr class="hover:bg-stone-50/60 transition-colors">
                            <td class="py-3.5 px-6 font-mono font-bold text-xs text-stone-900">
                                {{ $order->order_code }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-xs text-stone-900">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-stone-400 mt-0.5">{{ $order->customer_email }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-extrabold text-xs text-emerald-800 whitespace-nowrap">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($order->status === 'pending')
                                    <span class="badge badge-warning badge-sm uppercase font-bold text-[9px]">PENDING</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge badge-success badge-sm text-white uppercase font-bold text-[9px]">PAID</span>
                                @else
                                    <span class="badge badge-error badge-sm text-white uppercase font-bold text-[9px]">CANCELLED</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-xs text-stone-500 whitespace-nowrap">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg border border-stone-200">
                                    Lihat Rincian
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-xs text-stone-400">Tidak ada transaksi pesanan yang sesuai ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-stone-200 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
