@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Detail Pelanggan</h1>
            <p class="text-sm text-base-content/70">Informasi profil dan histori pembelian akun pelanggan</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6 space-y-4">
                <div class="flex items-center gap-3">
                    <div class="avatar placeholder">
                        <div class="bg-primary text-primary-content rounded-full w-12">
                            <span class="text-lg font-bold uppercase">{{ substr($user->name, 0, 2) }}</span>
                        </div>
                    </div>
                    <div>
                        <h2 class="font-bold text-base">{{ $user->name }}</h2>
                        <span class="badge badge-sm badge-outline badge-primary uppercase">{{ $user->role }}</span>
                    </div>
                </div>

                <div class="divider my-1"></div>

                <div class="space-y-3 text-sm">
                    <div>
                        <div class="text-xs text-base-content/60">Email</div>
                        <div class="font-semibold">{{ $user->email }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">No. Handphone</div>
                        <div class="font-semibold">{{ $user->phone ?? '-' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Alamat Default</div>
                        <div class="font-medium text-xs">{{ $user->address ?? 'Belum diisi' }}</div>
                    </div>
                    <div>
                        <div class="text-xs text-base-content/60">Tanggal Bergabung</div>
                        <div class="font-semibold">{{ $user->created_at->format('d F Y, H:i') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="md:col-span-2">
            <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                <h2 class="font-bold text-base mb-4">Riwayat Pesanan Pelanggan</h2>

                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-200 text-xs">
                                <th>Kode Order</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user->orders as $order)
                                <tr>
                                    <td class="font-mono font-bold text-xs">{{ $order->order_code }}</td>
                                    <td class="font-bold text-xs text-primary">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge badge-warning badge-sm uppercase">{{ $order->status }}</span>
                                        @elseif($order->status === 'paid')
                                            <span class="badge badge-success badge-sm text-white uppercase">{{ $order->status }}</span>
                                        @else
                                            <span class="badge badge-error badge-sm text-white uppercase">{{ $order->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-xs text-base-content/70">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-outline">Detail Order</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-6 text-base-content/60">Pelanggan ini belum melakukan transaksi pesanan.</td>
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
