@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- Header Banner -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Dashboard Pengelola</h1>
            <p class="text-xs text-stone-500 mt-0.5">Ringkasan aktivitas transaksi, katalog buku, dan pesanan masuk COD</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.books.create') }}" class="btn btn-sm bg-emerald-800 hover:bg-emerald-900 text-white rounded-xl text-xs font-semibold">
                + Tambah Buku
            </a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-outline border-stone-300 text-stone-700 hover:bg-stone-50 rounded-xl text-xs font-semibold">
                + Tambah Kategori
            </a>
        </div>
    </div>

    <!-- 4 Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Books -->
        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-stone-400">Total Judul Buku</div>
                <div class="text-2xl sm:text-3xl font-extrabold text-stone-900 mt-1">{{ $totalBooks }}</div>
                <div class="text-[11px] text-emerald-700 font-semibold mt-0.5">Koleksi terbitan</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center border border-emerald-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-stone-400">Total Kategori</div>
                <div class="text-2xl sm:text-3xl font-extrabold text-stone-900 mt-1">{{ $totalCategories }}</div>
                <div class="text-[11px] text-stone-500 font-semibold mt-0.5">Rumpun keilmuan</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-stone-100 text-stone-700 flex items-center justify-center border border-stone-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
        </div>

        <!-- Total Customers -->
        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-stone-400">Pelanggan Terdaftar</div>
                <div class="text-2xl sm:text-3xl font-extrabold text-stone-900 mt-1">{{ $totalUsers }}</div>
                <div class="text-[11px] text-stone-500 font-semibold mt-0.5">Akun pembeli aktif</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-700 flex items-center justify-center border border-sky-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs flex items-center justify-between">
            <div>
                <div class="text-[11px] font-bold uppercase tracking-wider text-stone-400">Pesanan Menunggu</div>
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-700 mt-1">{{ $totalPendingOrders }}</div>
                <div class="text-[11px] text-amber-600 font-semibold mt-0.5">Perlu konfirmasi COD</div>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center border border-amber-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

    </div>

    <!-- Recent Orders Table Section -->
    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
        <div class="p-5 border-b border-stone-200 flex items-center justify-between">
            <div>
                <h2 class="text-sm sm:text-base font-bold text-stone-900">Pesanan Masuk Terbaru</h2>
                <p class="text-xs text-stone-500 mt-0.5">Daftar transaksi pesanan terkini yang memerlukan tindak lanjut pengiriman</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-emerald-800 hover:underline">
                Semua Pesanan &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                        <th class="py-3 px-6">Kode Order</th>
                        <th class="py-3 px-4">Nama Pembeli</th>
                        <th class="py-3 px-4">Total Tagihan</th>
                        <th class="py-3 px-4">Status Pesanan</th>
                        <th class="py-3 px-4">Waktu Pesan</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-stone-50/60 transition-colors">
                            <td class="py-3.5 px-6 font-mono font-bold text-xs text-stone-900">
                                {{ $order->order_code }}
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-xs text-stone-900">{{ $order->customer_name }}</div>
                                <div class="text-[10px] text-stone-400 mt-0.5">{{ $order->user_id ? 'Member Terdaftar' : 'Tamu (Guest)' }}</div>
                            </td>
                            <td class="py-3.5 px-4 font-extrabold text-xs text-emerald-800 whitespace-nowrap">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($order->status === 'pending')
                                    <span class="badge badge-warning badge-sm uppercase font-bold text-[9px]">{{ $order->status }}</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge badge-success badge-sm text-white uppercase font-bold text-[9px]">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-error badge-sm text-white uppercase font-bold text-[9px]">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-xs text-stone-500 whitespace-nowrap">
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg border border-stone-200">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-xs text-stone-400">
                                Belum ada transaksi pesanan yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
