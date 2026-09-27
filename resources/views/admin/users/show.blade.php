@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Detail Pelanggan</h1>
            <p class="text-xs text-stone-500 mt-0.5">Informasi profil dan histori pembelian akun pelanggan di Aksara Pustaka</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm text-stone-600 hover:text-stone-900">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        
        <!-- Left: User Profile Card -->
        <div class="md:col-span-4">
            <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs p-6 space-y-4">
                <div class="flex items-center gap-3.5">
                    <div class="w-12 h-12 rounded-xl bg-emerald-800 text-white flex items-center justify-center font-bold text-base shadow-2xs uppercase">
                        {{ substr($user->name, 0, 2) }}
                    </div>
                    <div>
                        <h2 class="font-bold text-base text-stone-900">{{ $user->name }}</h2>
                        <span class="badge badge-sm bg-emerald-50 text-emerald-800 border-emerald-200 uppercase font-bold text-[9px] mt-0.5">
                            {{ $user->role }}
                        </span>
                    </div>
                </div>

                <div class="border-t border-stone-100 pt-4 space-y-3 text-xs">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Alamat Email</div>
                        <div class="font-semibold text-stone-800 mt-0.5">{{ $user->email }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">No. Handphone / WhatsApp</div>
                        <div class="font-semibold text-emerald-800 mt-0.5">{{ $user->phone ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Alamat Pengiriman Bawaan</div>
                        <div class="p-2.5 bg-stone-50 rounded-xl border border-stone-200 text-stone-700 mt-0.5 leading-relaxed">
                            {{ $user->address ?? 'Belum ada alamat tersimpan' }}
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Tanggal Bergabung</div>
                        <div class="font-semibold text-stone-700 mt-0.5">{{ $user->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Transaction History Table -->
        <div class="md:col-span-8">
            <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
                <div class="p-4 border-b border-stone-200 bg-stone-50/50">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900">Riwayat Transaksi Pesanan Pelanggan</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                                <th class="py-3 px-6">Kode Order</th>
                                <th class="py-3 px-4">Total Tagihan</th>
                                <th class="py-3 px-4">Status</th>
                                <th class="py-3 px-4">Waktu Transaksi</th>
                                <th class="py-3 px-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @forelse($user->orders as $order)
                                <tr class="hover:bg-stone-50/60 transition-colors">
                                    <td class="py-3.5 px-6 font-mono font-bold text-xs text-stone-900">{{ $order->order_code }}</td>
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
                                            Rincian
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-xs text-stone-400">Pelanggan ini belum pernah melakukan pemesanan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
