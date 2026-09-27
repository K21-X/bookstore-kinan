@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Detail Pesanan #{{ $order->order_code }}</h1>
            <p class="text-sm text-base-content/70">Waktu Transaksi: {{ $order->created_at->format('d F Y, H:i') }} WIB</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-4">Daftar Buku Pesanan</h2>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-200 text-xs">
                                <th>Buku</th>
                                <th class="text-right">Harga Satuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="font-bold text-sm">{{ $item->book_title }}</div>
                                        @if($item->book)
                                            <div class="text-xs text-base-content/60">Kategori: {{ $item->book->category->name ?? '-' }}</div>
                                        @endif
                                    </td>
                                    <td class="text-right text-xs">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center text-xs font-semibold">
                                        {{ $item->qty }}
                                    </td>
                                    <td class="text-right text-xs font-bold text-primary">
                                        Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="bg-base-100 font-bold">
                                <td colspan="3" class="text-right text-sm">Total Pembayaran:</td>
                                <td class="text-right text-primary text-base">
                                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-2">Alamat Pengiriman</h2>
                <p class="text-sm bg-base-200 p-4 rounded-lg leading-relaxed whitespace-pre-line">{{ $order->shipping_address }}</p>
            </div>
        </div>

        <div class="lg:col-span-1 space-y-6">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-4">Ubah Status Pesanan</h2>

                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Status Saat Ini</legend>
                        <select name="status" class="select select-bordered w-full">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>PENDING</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>PAID (Selesai/Lunas)</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>CANCELLED (Dibatalkan)</option>
                        </select>
                    </fieldset>

                    <button type="submit" class="btn btn-primary w-full btn-sm">Perbarui Status</button>
                </form>
            </div>

            <div class="card bg-base-100 shadow-sm border border-base-300 p-6 space-y-3">
                <h2 class="font-bold text-base mb-2">Informasi Pembeli</h2>

                <div class="text-sm space-y-2">
                    <div>
                        <div class="text-xs text-base-content/60">Tipe Pelanggan</div>
                        <div class="font-semibold">{{ $order->user_id ? 'Member Terdaftar' : 'Tamu (Guest)' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Nama</div>
                        <div class="font-semibold">{{ $order->customer_name }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Email</div>
                        <div class="font-semibold">{{ $order->customer_email }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">No. Handphone</div>
                        <div class="font-semibold">{{ $order->customer_phone ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Metode Pembayaran</div>
                        <div class="badge badge-outline badge-primary font-bold uppercase mt-1">{{ $order->payment_method }} (Bayar di Tempat)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
