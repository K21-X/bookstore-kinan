@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
    
    <!-- Header Keranjang -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-baseline justify-between pb-3 border-b border-stone-200 gap-2">
        <div>
            <h1 class="font-serif-title text-2xl font-bold text-stone-900">Keranjang Belanja</h1>
            <p class="text-xs text-stone-500 mt-0.5">Periksa judul dan jumlah buku sebelum melanjutkan ke pengiriman</p>
        </div>
        @if(count($cart) > 0)
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan keranjang belanja?')">
                @csrf
                <button type="submit" class="text-xs text-stone-400 hover:text-rose-600 transition-colors">
                    Kosongkan Keranjang
                </button>
            </form>
        @endif
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Daftar Buku dalam Keranjang -->
            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-xl border border-stone-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full text-xs">
                            <thead>
                                <tr class="bg-stone-50 border-b border-stone-200 text-stone-600 font-semibold uppercase text-[11px]">
                                    <th class="py-3 px-4">Buku</th>
                                    <th class="py-3 px-3">Harga</th>
                                    <th class="py-3 px-3 text-center">Jumlah</th>
                                    <th class="py-3 px-3">Subtotal</th>
                                    <th class="py-3 px-3 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @foreach($cart as $item)
                                    <tr class="hover:bg-stone-50/50 transition-colors">
                                        <!-- Cover & Judul -->
                                        <td class="py-3.5 px-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-14 bg-stone-50 rounded overflow-hidden shrink-0 flex items-center justify-center border border-stone-200">
                                                    @if(!empty($item['cover']))
                                                        <img src="{{ asset('storage/' . $item['cover']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover" />
                                                    @else
                                                        <span class="text-[8px] text-stone-400 font-semibold">BUKU</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-semibold text-stone-900 line-clamp-1">{{ $item['title'] }}</div>
                                                    <div class="text-[11px] text-stone-500 mt-0.5">{{ $item['author'] }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Harga -->
                                        <td class="py-3.5 px-3 text-stone-700 whitespace-nowrap">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>

                                        <!-- Ubah Jumlah -->
                                        <td class="py-3.5 px-3">
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center justify-center gap-1">
                                                @csrf
                                                @method('PATCH')
                                                <input 
                                                    type="number" 
                                                    name="qty" 
                                                    value="{{ $item['qty'] }}" 
                                                    min="1" 
                                                    max="{{ $item['stock'] }}" 
                                                    class="w-12 px-1.5 py-1 bg-stone-50 border border-stone-200 rounded text-center text-xs font-semibold outline-none focus:bg-white focus:border-stone-400" 
                                                />
                                                <button type="submit" class="p-1 text-stone-400 hover:text-stone-900 transition-colors" title="Simpan Jumlah">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="py-3.5 px-3 font-semibold text-stone-900 whitespace-nowrap">
                                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                        </td>

                                        <!-- Hapus -->
                                        <td class="py-3.5 px-3 text-right">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari keranjang?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-stone-400 hover:text-rose-600 transition-colors" title="Hapus Buku">
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
                </div>

                <div>
                    <a href="{{ route('books.index') }}" class="text-xs text-stone-600 hover:text-stone-900 font-medium inline-flex items-center gap-1">
                        &larr; Lanjut Memilih Buku Lain
                    </a>
                </div>
            </div>

            <!-- Ringkasan Pesanan Kanan -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl border border-stone-200 p-5 space-y-4">
                    <h2 class="font-semibold text-xs text-stone-900 uppercase tracking-wider pb-2 border-b border-stone-100">
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-2 text-xs text-stone-600">
                        <div class="flex justify-between">
                            <span>Jumlah Buku:</span>
                            <span class="font-semibold text-stone-900">{{ collect($cart)->sum('qty') }} eksemplar</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span class="font-semibold text-stone-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Metode Bayar:</span>
                            <span class="text-stone-800">COD (Tunai saat Sampai)</span>
                        </div>
                        <div class="flex justify-between text-stone-500 text-[11px]">
                            <span>Kemasan Pelindung:</span>
                            <span>Termasuk</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-stone-100 flex justify-between items-baseline">
                        <span class="text-xs font-semibold text-stone-900">Total Pembayaran:</span>
                        <span class="text-lg font-bold text-stone-900">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs text-center transition-colors">
                        Lanjut ke Checkout &rarr;
                    </a>

                    <p class="text-[11px] text-stone-400 leading-normal text-center">
                        Pembayaran tunai dilakukan kepada kurir saat pesanan tiba di alamat Anda.
                    </p>
                </div>
            </div>

        </div>
    @else
        <div class="py-16 text-center bg-white rounded-xl border border-stone-200 p-8 max-w-lg mx-auto">
            <h2 class="text-sm font-semibold text-stone-800">Keranjang Belanja Masih Kosong</h2>
            <p class="text-xs text-stone-400 mt-1">Anda belum menambahkan buku ke dalam keranjang belanja.</p>
            <a href="{{ route('books.index') }}" class="inline-block mt-4 px-4 py-2 bg-stone-900 text-white text-xs font-medium rounded-lg hover:bg-stone-800 transition-colors">
                Mulai Belanja Buku
            </a>
        </div>
    @endif

</div>
@endsection
