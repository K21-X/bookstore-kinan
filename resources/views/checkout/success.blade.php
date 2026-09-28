@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 sm:px-6 py-10 sm:py-12">
    
    <!-- Kartu Bukti Pesanan Bersih -->
    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8 text-center">
        
        <div class="w-12 h-12 rounded-full bg-stone-100 text-stone-800 flex items-center justify-center mx-auto mb-3 border border-stone-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1 class="font-serif-title text-2xl font-bold text-stone-900">Pesanan Berhasil Diterima</h1>
        <p class="text-xs text-stone-500 mt-1 max-w-sm mx-auto">
            Terima kasih telah berbelanja di Alinea Bookstore. Paket pesanan Anda segera kami kemas dan kirimkan.
        </p>

        <!-- Rincian Nota Sederhana -->
        <div class="my-6 p-4 sm:p-5 rounded-lg bg-stone-50 border border-stone-200 text-left space-y-2.5 text-xs">
            <div class="flex justify-between items-center pb-2 border-b border-stone-200">
                <span class="text-stone-400 font-semibold text-[11px]">Kode Pesanan:</span>
                <span class="font-mono font-bold text-stone-900">{{ $order->order_code }}</span>
            </div>
            <div class="flex justify-between items-center pb-2 border-b border-stone-200">
                <span class="text-stone-500">Penerima:</span>
                <span class="font-medium text-stone-800">{{ $order->customer_name }}</span>
            </div>
            <div class="flex justify-between items-center pb-2 border-b border-stone-200">
                <span class="text-stone-500">Metode Bayar:</span>
                <span class="font-medium text-stone-800">COD (Tunai saat Sampai)</span>
            </div>
            <div class="flex justify-between items-start pb-2 border-b border-stone-200">
                <span class="text-stone-500">Alamat Kirim:</span>
                <span class="font-medium text-stone-700 text-right max-w-xs text-[11px]">{{ $order->shipping_address }}</span>
            </div>

            <!-- Daftar Buku -->
            <div class="py-1.5 space-y-1">
                <div class="font-semibold text-stone-600 text-[11px]">Daftar Buku:</div>
                @foreach($order->items as $item)
                    <div class="flex justify-between text-[11px] text-stone-600">
                        <span class="truncate max-w-[240px]">{{ $item->book_title }} ({{ $item->qty }}x)</span>
                        <span class="font-semibold text-stone-800 whitespace-nowrap">Rp {{ number_format($item->price * $item->qty, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-between items-baseline pt-2 border-t border-stone-200">
                <span class="font-semibold text-stone-900 text-xs">Total Tagihan COD:</span>
                <span class="font-bold text-base text-stone-900">
                    Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <div class="p-3 bg-stone-100 rounded-lg text-left text-xs text-stone-600 space-y-0.5 mb-6">
            <span class="font-semibold text-stone-800 block text-[11px]">Catatan Pengiriman:</span>
            <p class="text-[11px] text-stone-500 leading-relaxed">
                Siapkan uang tunai pas sebesar <strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong> saat kurir mengantarkan buku ke alamat Anda.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-2.5">
            <a href="{{ route('books.index') }}" class="flex-1 py-2 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs transition-colors">
                Lanjut Belanja Buku
            </a>
            <button onclick="window.print()" type="button" class="py-2 px-4 rounded-lg border border-stone-200 hover:bg-stone-50 text-stone-700 font-medium text-xs transition-colors">
                Cetak Struk
            </button>
        </div>
    </div>

</div>
@endsection
