@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 sm:py-12">
    
    <!-- Steps Indicator -->
    <div class="mb-8 flex items-center justify-center">
        <div class="flex items-center gap-2 sm:gap-4 text-xs font-semibold">
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Keranjang</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-emerald-800"></div>
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Checkout</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-emerald-800"></div>
            <div class="flex items-center gap-2 text-emerald-800 font-bold">
                <span class="w-6 h-6 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs">3</span>
                <span>Pesanan Berhasil</span>
            </div>
        </div>
    </div>

    <!-- Success Receipt Card -->
    <div class="bg-white rounded-3xl border border-stone-200 p-6 sm:p-10 shadow-2xs text-center">
        <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-800 flex items-center justify-center mx-auto mb-4 border border-emerald-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="font-book-title text-2xl sm:text-3xl font-bold text-stone-900">Pesanan Berhasil Dibuat!</h1>
        <p class="text-xs text-stone-500 mt-1 max-w-sm mx-auto">
            Terima kasih telah berbelanja di Aksara Pustaka. Paket pesanan Anda sedang disiapkan dan akan dikirim ke alamat tujuan.
        </p>

        <!-- Official Receipt Detail Box -->
        <div class="my-8 p-5 sm:p-6 rounded-2xl bg-stone-50 border border-stone-200 text-left space-y-3 text-xs">
            <div class="flex justify-between items-center pb-2.5 border-b border-stone-200">
                <span class="text-stone-400 font-bold uppercase tracking-wider text-[10px]">Nomor Kode Pesanan</span>
                <span class="font-mono font-extrabold text-sm text-emerald-800">{{ $order->order_code }}</span>
            </div>
            <div class="flex justify-between items-center pb-2.5 border-b border-stone-200">
                <span class="text-stone-500">Penerima Paket</span>
                <span class="font-bold text-stone-800">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between items-center pb-2.5 border-b border-stone-200">
                <span class="text-stone-500">Status Pesanan</span>
                <span class="px-2 py-0.5 rounded bg-amber-50 text-amber-800 font-bold uppercase text-[10px] border border-amber-200">
                    {{ $order->status }} (Menunggu Proses)
                </span>
            </div>
            <div class="flex justify-between items-center pb-2.5 border-b border-stone-200">
                <span class="text-stone-500">Metode Pembayaran</span>
                <span class="font-bold text-stone-800 uppercase">COD (Bayar di Tempat)</span>
            </div>
            <div class="flex justify-between items-start pb-2.5 border-b border-stone-200">
                <span class="text-stone-500">Alamat Pengiriman</span>
                <span class="font-medium text-stone-700 text-right max-w-xs">{{ $order->shipping_address }}</span>
            </div>

            <!-- Items list in receipt -->
            <div class="py-2 space-y-1.5">
                <div class="font-bold text-stone-600 text-[11px] uppercase tracking-wider">Daftar Buku:</div>
                @foreach($order->items as $item)
                    <div class="flex justify-between text-[11px] text-stone-600">
                        <span>{{ $item->book_title }} ({{ $item->qty }}x)</span>
                        <span class="font-semibold text-stone-800">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-baseline pt-2 border-t border-stone-200">
                <span class="font-bold text-stone-900 text-xs">Total Pembayaran Tunai (COD):</span>
                <span class="font-extrabold text-lg text-emerald-800">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Next Instructions -->
        <div class="p-4 bg-emerald-50/60 rounded-xl border border-emerald-200 text-xs text-emerald-900 text-left space-y-1 mb-6">
            <div class="font-bold">Informasi Penting:</div>
            <p class="text-[11px] text-emerald-800 leading-relaxed">
                Harap siapkan uang pas sebesar <strong class="text-emerald-950">Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> saat kurir mengantarkan buku ke alamat Anda. Kurir mungkin akan menghubungi nomor telepon Anda sebelum pengantaran.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('books.index') }}" class="flex-1 py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs transition-colors shadow-2xs">
                Kembali Belanja Buku
            </a>
            <button onclick="window.print()" type="button" class="py-3 px-6 rounded-xl border border-stone-300 hover:bg-stone-50 text-stone-700 font-bold text-xs transition-colors">
                Cetak Struk
            </button>
        </div>
    </div>

</div>
@endsection
