@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">Kelola Pesanan Buku</h1>
        <p class="text-sm text-base-content/70">Daftar transaksi pesanan masuk dari pembeli</p>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200 flex flex-col sm:flex-row gap-2">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 w-full">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode order / pembeli..." class="input input-sm input-bordered w-full sm:w-64" />
                <select name="status" class="select select-sm select-bordered w-full sm:w-40">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs">
                        <th>Kode Order</th>
                        <th>Pembeli</th>
                        <th>Total Tagihan</th>
                        <th>Status</th>
                        <th>Update Status</th>
                        <th>Tanggal</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="font-mono font-bold text-xs">{{ $order->order_code }}</td>
                            <td>
                                <div class="font-semibold text-xs">{{ $order->customer_name }}</div>
                                <div class="text-[11px] text-base-content/60">{{ $order->user_id ? 'Member' : 'Tamu (Guest)' }}</div>
                            </td>
                            <td class="font-bold text-xs text-primary">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($order->status === 'pending')
                                    <span class="badge badge-warning badge-sm uppercase">{{ $order->status }}</span>
                                @elseif($order->status === 'paid')
                                    <span class="badge badge-success badge-sm text-white uppercase">{{ $order->status }}</span>
                                @else
                                    <span class="badge badge-error badge-sm text-white uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.orders.status', $order) }}" method="POST" class="flex items-center gap-1">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="select select-xs select-bordered">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    <button type="submit" class="btn btn-xs btn-outline">Ubah</button>
                                </form>
                            </td>
                            <td class="text-xs text-base-content/70">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-outline">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-base-content/60">Tidak ada pesanan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-base-200 flex justify-center">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
