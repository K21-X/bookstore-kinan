@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <div class="flex items-center gap-2">
                <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Detail Pesanan #{{ $order->order_code }}</h1>
                @if($order->status === 'pending')
                    <span class="badge badge-warning badge-sm uppercase font-bold text-[9px]">PENDING</span>
                @elseif($order->status === 'paid')
                    <span class="badge badge-success badge-sm text-white uppercase font-bold text-[9px]">PAID</span>
                @else
                    <span class="badge badge-error badge-sm text-white uppercase font-bold text-[9px]">CANCELLED</span>
                @endif
            </div>
            <p class="text-xs text-stone-500 mt-0.5">Waktu Transaksi: {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm text-stone-600 hover:text-stone-900">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- Left: Items Ordered Table -->
        <div class="lg:col-span-8 space-y-6">
            <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
                <div class="p-4 border-b border-stone-200 bg-stone-50/50">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900">Daftar Buku Pesanan</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                                <th class="py-3 px-6">Buku</th>
                                <th class="py-3 px-4 text-right">Harga Satuan</th>
                                <th class="py-3 px-4 text-center">Jumlah</th>
                                <th class="py-3 px-6 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100">
                            @foreach($order->items as $item)
                                <tr class="hover:bg-stone-50/60 transition-colors">
                                    <td class="py-3.5 px-6">
                                        <div class="font-bold text-xs sm:text-sm text-stone-900">{{ $item->book_title }}</div>
                                        @if($item->book)
                                            <div class="text-[11px] text-stone-400 mt-0.5">Kategori: {{ $item->book->category->name ?? '-' }}</div>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-4 text-right text-xs text-stone-600 whitespace-nowrap">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3.5 px-4 text-center text-xs font-bold text-stone-700">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="py-3.5 px-6 text-right text-xs font-extrabold text-emerald-800 whitespace-nowrap">
                                        Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-stone-50 font-bold border-t border-stone-200">
                                <td colspan="3" class="py-4 px-6 text-right text-xs uppercase tracking-wider text-stone-500">Total Pembayaran Tunai (COD):</td>
                                <td class="py-4 px-6 text-right text-emerald-800 text-base font-extrabold whitespace-nowrap">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Status Update Form & Customer Info -->
        <div class="lg:col-span-4 space-y-6">
            
            <!-- Update Order Status Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs space-y-4">
                <h3 class="font-bold text-xs sm:text-sm text-stone-900 pb-2 border-b border-stone-100">
                    Ubah Status Pesanan
                </h3>

                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-3">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="status" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Pilih Status Baru</label>
                        <select id="status" name="status" class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending (Menunggu Konfirmasi)</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid (Terkirim & Pembayaran Selesai)</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl shadow-2xs transition-colors">
                        Perbarui Status Pesanan
                    </button>
                </form>
            </div>

            <!-- Customer Shipping Info Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs space-y-3">
                <h3 class="font-bold text-xs sm:text-sm text-stone-900 pb-2 border-b border-stone-100">
                    Data Pengiriman Paket
                </h3>

                <div class="space-y-2 text-xs">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Penerima</div>
                        <div class="font-bold text-stone-900 mt-0.5">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Alamat Email</div>
                        <div class="text-stone-700 mt-0.5">{{ $order->customer_email }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">No. Handphone / WhatsApp</div>
                        <div class="font-semibold text-emerald-800 mt-0.5">{{ $order->customer_phone ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Alamat Lengkap Tujuan</div>
                        <div class="p-2.5 bg-stone-50 rounded-xl border border-stone-200 text-stone-700 mt-0.5 leading-relaxed">
                            {{ $order->shipping_address }}
                        </div>
                    </div>
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-wider text-stone-400">Metode Bayar</div>
                        <div class="font-bold text-stone-900 mt-0.5 uppercase">{{ $order->payment_method }} (Bayar di Tempat)</div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
