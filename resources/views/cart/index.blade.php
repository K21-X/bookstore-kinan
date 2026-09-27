@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl md:text-3xl font-bold">Keranjang Belanja</h1>
        @if(count($cart) > 0)
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Kosongkan semua item di keranjang?')">
                @csrf
                <button type="submit" class="btn btn-ghost btn-sm text-error">Kosongkan Keranjang</button>
            </form>
        @endif
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                <div class="card bg-base-100 shadow-sm border border-base-300 overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr class="bg-base-200 text-xs uppercase">
                                <th>Buku</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-16 bg-base-200 rounded overflow-hidden flex-shrink-0 flex items-center justify-center border border-base-300">
                                                @if(!empty($item['cover']))
                                                    <img src="{{ asset('storage/' . $item['cover']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover" />
                                                @else
                                                    <span class="text-[10px] font-bold text-base-content/40">BUKU</span>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="font-bold text-sm line-clamp-1">{{ $item['title'] }}</div>
                                                <div class="text-xs text-base-content/60">{{ $item['author'] }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm font-semibold">
                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center justify-center gap-1">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="qty" value="{{ $item['qty'] }}" min="1" max="{{ $item['stock'] }}" class="input input-xs input-bordered w-16 text-center" />
                                            <button type="submit" class="btn btn-xs btn-ghost" title="Update">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-sm font-bold text-primary">
                                        Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                    </td>
                                    <td class="text-right">
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" onsubmit="return confirm('Hapus item ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-ghost text-error">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('books.index') }}" class="btn btn-ghost btn-sm">
                    &larr; Tambah Buku Lainnya
                </a>
            </div>

            <div class="lg:col-span-1">
                <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                    <h2 class="font-bold text-lg mb-4">Ringkasan Belanja</h2>
                    
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-base-content/70">Total Item</span>
                            <span class="font-bold">{{ array_sum(array_column($cart, 'qty')) }} item</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-base-content/70">Metode Pembayaran</span>
                            <span class="badge badge-outline badge-primary font-bold">COD (Bayar di Tempat)</span>
                        </div>
                        <div class="divider my-2"></div>
                        <div class="flex justify-between text-base font-extrabold">
                            <span>Total Harga</span>
                            <span class="text-primary text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="btn btn-primary w-full mt-6">
                        Lanjut ke Pembayaran &rarr;
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="card bg-base-100 shadow-sm border border-base-300 p-12 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-base-content/30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h2 class="text-xl font-bold">Keranjang Anda Masih Kosong</h2>
            <p class="text-base-content/60 text-sm mt-1">Anda belum menambahkan buku apapun ke dalam keranjang.</p>
            <div class="mt-6">
                <a href="{{ route('books.index') }}" class="btn btn-primary">Mulai Belanja Sekarang</a>
            </div>
        </div>
    @endif
</div>
@endsection
