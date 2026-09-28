@extends('layouts.app')

@section('content')
<!-- Breadcrumbs Ringkas -->
<div class="border-b border-stone-200 py-3 bg-white">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-xs text-stone-500 flex items-center gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-stone-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('books.index') }}" class="hover:text-stone-900 transition-colors">Katalog</a>
            <span>/</span>
            <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="hover:text-stone-900 transition-colors">{{ $book->category->name }}</a>
            <span>/</span>
            <span class="text-stone-800 font-medium truncate max-w-xs">{{ $book->title }}</span>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-10">
    
    <!-- Detail Buku Utama -->
    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8 mb-12">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12">
            
            <!-- Kolom Kiri: Cover Buku -->
            <div class="md:col-span-5 lg:col-span-4">
                <div class="bg-stone-50 rounded-lg overflow-hidden border border-stone-200 flex items-center justify-center p-4">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full max-w-[260px] h-auto object-cover rounded shadow-sm" />
                    @else
                        <div class="text-center py-16 text-stone-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-xs uppercase tracking-wider">{{ $book->category->name }}</span>
                        </div>
                    @endif
                </div>

                <div class="mt-4 p-3 bg-stone-50 rounded-lg border border-stone-100 text-[11px] text-stone-500 space-y-1">
                    <div>• Jaminan buku 100% orisinal bersegel</div>
                    <div>• Pembayaran tunai saat barang tiba (COD)</div>
                    <div>• Pengemasan dengan pelindung sudut buku</div>
                </div>
            </div>

            <!-- Kolom Kanan: Informasi & Pembelian -->
            <div class="md:col-span-7 lg:col-span-8 flex flex-col justify-between">
                <div>
                    <!-- Kategori -->
                    <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="text-[11px] uppercase font-semibold tracking-wider text-stone-500 hover:text-stone-800 transition-colors inline-block mb-1.5">
                        {{ $book->category->name }}
                    </a>

                    <!-- Judul Buku -->
                    <h1 class="font-serif-title text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight leading-snug">
                        {{ $book->title }}
                    </h1>

                    <p class="text-xs sm:text-sm text-stone-500 mt-1">
                        Karya: <strong class="text-stone-800">{{ $book->author }}</strong>
                    </p>

                    <!-- Harga & Ketersediaan -->
                    <div class="my-5 pb-5 border-b border-stone-100 flex items-baseline justify-between">
                        <div>
                            <span class="text-2xl font-bold text-stone-900">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div>
                            <span class="text-xs {{ $book->stock > 0 ? 'text-stone-600' : 'text-rose-600 font-semibold' }}">
                                {{ $book->stock > 0 ? 'Stok tersedia: ' . $book->stock . ' eksemplar' : 'Stok habis' }}
                            </span>
                        </div>
                    </div>

                    <!-- Sinopsis / Deskripsi -->
                    <div class="space-y-2 mb-6">
                        <h2 class="text-xs font-semibold uppercase tracking-wider text-stone-700">Sinopsis Buku</h2>
                        <div class="text-xs sm:text-sm text-stone-600 leading-relaxed whitespace-pre-line">
                            {{ $book->description }}
                        </div>
                    </div>
                </div>

                <!-- Formulir Tambah ke Keranjang -->
                <div class="pt-5 border-t border-stone-100">
                    @if($book->stock > 0)
                        <form action="{{ route('cart.add', $book) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-3">
                            @csrf
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <label for="qty" class="text-xs font-medium text-stone-600 whitespace-nowrap">Jumlah:</label>
                                <input 
                                    type="number" 
                                    id="qty" 
                                    name="qty" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $book->stock }}" 
                                    class="w-20 px-2.5 py-2 bg-stone-50 border border-stone-200 rounded-lg text-center font-bold text-xs outline-none focus:bg-white focus:border-stone-400" 
                                />
                            </div>
                            <button type="submit" class="w-full sm:w-auto flex-1 py-2.5 px-6 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs sm:text-sm flex items-center justify-center gap-2 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Masukkan ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="p-3 bg-stone-50 border border-stone-200 text-stone-600 text-xs rounded-lg text-center">
                            Persediaan buku ini sedang habis. Silakan pilih judul buku lain di katalog kami.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Buku Terkait dalam Kategori yang Sama -->
    @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="my-8">
            <h2 class="font-serif-title text-xl font-bold text-stone-900 mb-4 pb-2 border-b border-stone-200">
                Buku Terkait
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedBooks as $related)
                    <div class="bg-white rounded-xl border border-stone-200 hover:border-stone-400 transition-all flex flex-col justify-between overflow-hidden group">
                        <div>
                            <a href="{{ route('books.show', $related) }}" class="block bg-stone-50 aspect-3/4 relative overflow-hidden border-b border-stone-100">
                                @if($related->cover)
                                    <img src="{{ asset('storage/' . $related->cover) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300" />
                                @else
                                    <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center text-stone-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif
                            </a>

                            <div class="p-3">
                                <a href="{{ route('books.show', $related) }}" class="block font-semibold text-stone-900 text-xs line-clamp-1 hover:text-stone-600 transition-colors">
                                    {{ $related->title }}
                                </a>
                                <p class="text-[11px] text-stone-500 mt-0.5 truncate">{{ $related->author }}</p>
                            </div>
                        </div>

                        <div class="p-3 pt-0">
                            <div class="pt-2 border-t border-stone-100 flex items-center justify-between mb-2">
                                <span class="text-xs font-bold text-stone-900">
                                    Rp {{ number_format($related->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('books.show', $related) }}" class="block w-full py-1.5 rounded-lg border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-medium text-center transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
