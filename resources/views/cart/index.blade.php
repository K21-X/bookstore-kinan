@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    
    <!-- Steps Indicator -->
    <div class="mb-8 flex items-center justify-center">
        <div class="flex items-center gap-2 sm:gap-4 text-xs font-semibold">
            <div class="flex items-center gap-2 text-emerald-800 font-bold">
                <span class="w-6 h-6 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs">1</span>
                <span>Keranjang Belanja</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-stone-200"></div>
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">2</span>
                <span class="hidden sm:inline">Checkout COD</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-stone-200"></div>
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">3</span>
                <span class="hidden sm:inline">Pesanan Selesai</span>
            </div>
        </div>
    </div>

    <!-- Header Cart Area -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="font-book-title text-2xl sm:text-3xl font-bold text-stone-900">Keranjang Belanja Anda</h1>
            <p class="text-xs text-stone-500 mt-0.5">Periksa kembali judul dan jumlah buku yang ingin Anda pesan</p>
        </div>
        @if(count($cart) > 0)
            <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengosongkan keranjang belanja?')">
                @csrf
                <button type="submit" class="text-xs font-semibold text-rose-600 hover:text-rose-700 hover:underline">
                    Kosongkan Keranjang
                </button>
            </form>
        @endif
    </div>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Items Table in Left Area -->
            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table w-full">
                            <thead>
                                <tr class="bg-stone-50 border-b border-stone-200 text-xs font-bold text-stone-500 uppercase tracking-wider">
                                    <th class="py-3.5 px-6">Buku</th>
                                    <th class="py-3.5 px-4">Harga Satuan</th>
                                    <th class="py-3.5 px-4 text-center">Jumlah</th>
                                    <th class="py-3.5 px-4">Subtotal</th>
                                    <th class="py-3.5 px-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-stone-100">
                                @foreach($cart as $item)
                                    <tr class="hover:bg-stone-50/60 transition-colors">
                                        <!-- Cover & Title -->
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3.5">
                                                <div class="w-12 h-16 bg-stone-100 rounded-lg overflow-hidden shrink-0 flex items-center justify-center border border-stone-200">
                                                    @if(!empty($item['cover']))
                                                        <img src="{{ asset('storage/' . $item['cover']) }}" alt="{{ $item['title'] }}" class="w-full h-full object-cover" />
                                                    @else
                                                        <span class="text-[9px] font-bold text-stone-400">BUKU</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="font-bold text-xs sm:text-sm text-stone-900 line-clamp-1">{{ $item['title'] }}</div>
                                                    <div class="text-[11px] text-stone-500 mt-0.5">{{ $item['author'] }}</div>
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Price -->
                                        <td class="py-4 px-4 text-xs font-medium text-stone-700 whitespace-nowrap">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </td>

                                        <!-- Qty Update Form -->
                                        <td class="py-4 px-4">
                                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="flex items-center justify-center gap-1.5">
                                                @csrf
                                                @method('PATCH')
                                                <input 
                                                    type="number" 
                                                    name="qty" 
                                                    value="{{ $item['qty'] }}" 
                                                    min="1" 
                                                    max="{{ $item['stock'] }}" 
                                                    class="w-14 px-2 py-1 bg-stone-50 border border-stone-200 rounded-lg text-center text-xs font-bold outline-none focus:bg-white focus:border-emerald-700" 
                                                />
                                                <button type="submit" class="p-1 rounded-md hover:bg-stone-200/80 text-stone-500 hover:text-emerald-800 transition-colors" title="Simpan Perubahan Jumlah">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Subtotal -->
                                        <td class="py-4 px-4 text-xs font-extrabold text-emerald-800 whitespace-nowrap">
                                            Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                        </td>

                                        <!-- Remove Item -->
                                        <td class="py-4 px-4 text-right">
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST" onsubmit="return confirm('Hapus buku ini dari keranjang?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-1.5 text-stone-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus Buku">
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

                <div class="flex items-center justify-between pt-2">
                    <a href="{{ route('books.index') }}" class="text-xs font-semibold text-emerald-800 hover:underline inline-flex items-center gap-1.5">
                        &larr; Tambah Buku Lainnya
                    </a>
                </div>
            </div>

            <!-- Right Area: Order Summary Card -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-2xs space-y-4 sticky top-24">
                    <h3 class="font-bold text-sm text-stone-900 pb-3 border-b border-stone-100">
                        Ringkasan Pembelian
                    </h3>

                    <div class="space-y-2.5 text-xs text-stone-600">
                        <div class="flex justify-between">
                            <span>Jumlah Buku:</span>
                            <span class="font-bold text-stone-900">{{ collect($cart)->sum('qty') }} item</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Harga Buku:</span>
                            <span class="font-bold text-stone-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Metode Pembayaran:</span>
                            <span class="font-bold text-emerald-800">COD (Bayar di Tempat)</span>
                        </div>
                        <div class="flex justify-between text-emerald-800 font-semibold">
                            <span>Biaya Pengemasan Bubble:</span>
                            <span>Gratis</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-stone-100 flex justify-between items-baseline">
                        <span class="text-xs font-bold text-stone-900">Total Tagihan COD:</span>
                        <span class="text-xl font-extrabold text-emerald-800">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs text-center shadow-2xs transition-colors">
                        Lanjut ke Checkout COD &rarr;
                    </a>

                    <div class="p-3 rounded-xl bg-stone-50 border border-stone-200 text-[11px] text-stone-500 leading-normal">
                        💡 <strong>Belanja Nyaman:</strong> Anda tidak perlu transfer uang terlebih dahulu. Siapkan uang tunai saat pesanan Anda diantar oleh kurir.
                    </div>
                </div>
            </div>

        </div>
    @else
        <!-- Empty Cart State -->
        <div class="py-16 text-center bg-white rounded-3xl border border-stone-200 p-8 max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="font-book-title text-lg font-bold text-stone-900">Keranjang Belanja Anda Masih Kosong</h2>
            <p class="text-xs text-stone-500 mt-1 max-w-xs mx-auto">
                Belum ada buku yang Anda pilih. Silakan jelajahi koleksi buku menarik kami di katalog.
            </p>
            <a href="{{ route('books.index') }}" class="btn btn-sm bg-emerald-800 hover:bg-emerald-900 text-white font-bold mt-5 rounded-xl">
                Eksplorasi Katalog Buku
            </a>
        </div>
    @endif

</div>
@endsection
