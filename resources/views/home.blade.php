@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
    
    <!-- Hero Section Editorial & Hangat -->
    <section class="bg-stone-100/80 border border-stone-200/80 rounded-2xl p-6 sm:p-10 lg:p-12 mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Teks Hero -->
            <div class="lg:col-span-7 space-y-4">
                <span class="text-[11px] uppercase font-semibold tracking-wider text-stone-500">
                    Toko Buku & Kurasi Pustaka
                </span>
                
                <h1 class="font-serif-title text-3xl sm:text-4xl lg:text-5xl font-bold text-stone-900 tracking-tight leading-[1.2]">
                    Tempat tenang untuk menemukan bacaan bermutu.
                </h1>
                
                <p class="text-stone-600 text-xs sm:text-sm leading-relaxed max-w-xl">
                    Koleksi terkurasi dari ragam karya sastra, filsafat, teknologi, bisnis, dan humaniora. Pesan dengan mudah tanpa harus transfer, cukup bayar tunai saat buku tiba di rumah (COD).
                </p>

                <div class="pt-2 flex flex-wrap items-center gap-3">
                    <a href="{{ route('books.index') }}" class="px-5 py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white text-xs font-semibold transition-colors shadow-xs">
                        Jelajahi Katalog Buku
                    </a>
                    <a href="{{ route('about') }}" class="px-5 py-2.5 rounded-lg border border-stone-300 hover:bg-stone-200/60 text-stone-700 text-xs font-semibold transition-colors">
                        Tentang Kami
                    </a>
                </div>

                <div class="pt-3 text-[11px] text-stone-500 flex flex-wrap items-center gap-x-4 gap-y-1">
                    <span>✓ Buku 100% Original Penerbit</span>
                    <span>✓ Bayar di Tempat (COD)</span>
                    <span>✓ Pengemasan Berlapis Aman</span>
                </div>
            </div>

            <!-- Spotlight Buku Rekomendasi -->
            <div class="lg:col-span-5">
                @if($latestBooks->count() > 0)
                    @php $featured = $latestBooks->first(); @endphp
                    <div class="bg-white border border-stone-200 rounded-xl p-5 shadow-xs max-w-sm mx-auto">
                        <div class="flex items-center justify-between text-[11px] text-stone-400 mb-3 pb-2 border-b border-stone-100">
                            <span class="uppercase tracking-wider font-semibold text-stone-500">Sorotan Pembaca</span>
                            <span>{{ $featured->category->name }}</span>
                        </div>

                        <div class="aspect-4/3 w-full bg-stone-50 rounded-lg overflow-hidden mb-3.5 border border-stone-100 flex items-center justify-center">
                            @if($featured->cover)
                                <img src="{{ asset('storage/' . $featured->cover) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover" />
                            @else
                                <div class="text-center p-4 text-stone-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-1 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-[10px] uppercase tracking-wider">{{ $featured->category->name }}</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="font-semibold text-stone-900 text-sm line-clamp-1">{{ $featured->title }}</h3>
                        <p class="text-xs text-stone-500 mt-0.5">Penulis: {{ $featured->author }}</p>

                        <div class="mt-3 pt-3 border-t border-stone-100 flex items-center justify-between">
                            <div>
                                <span class="text-sm font-bold text-stone-900">Rp {{ number_format($featured->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <a href="{{ route('books.show', $featured) }}" class="px-3 py-1.5 rounded-lg border border-stone-200 text-stone-700 hover:bg-stone-50 text-xs font-medium transition-colors">
                                    Detail
                                </a>
                                @if($featured->stock > 0)
                                    <form action="{{ route('cart.add', $featured) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white text-xs font-medium transition-colors">
                                            + Keranjang
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <!-- Kategori Pilihan (Minimalist Shelf) -->
    <section class="mb-12">
        <div class="flex items-baseline justify-between mb-4 pb-2 border-b border-stone-200">
            <div>
                <h2 class="font-serif-title text-xl font-bold text-stone-900">Kategori Pustaka</h2>
                <p class="text-xs text-stone-500 mt-0.5">Pilih kategori untuk mempermudah pencarian bacaan</p>
            </div>
            <a href="{{ route('books.index') }}" class="text-xs text-stone-600 hover:text-stone-900 font-medium">
                Semua Kategori &rarr;
            </a>
        </div>

        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('books.index') }}" class="px-3.5 py-1.5 rounded-lg text-xs font-medium border border-stone-200 bg-white hover:border-stone-400 text-stone-800 transition-colors">
                Semua Koleksi
            </a>
            @foreach($categories as $category)
                <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="px-3.5 py-1.5 rounded-lg text-xs font-medium border border-stone-200 bg-white hover:border-stone-400 text-stone-800 transition-colors flex items-center gap-1.5">
                    <span>{{ $category->name }}</span>
                    <span class="text-[10px] text-stone-400">({{ $category->books_count }})</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Koleksi Buku Terbaru -->
    <section class="mb-14">
        <div class="flex items-baseline justify-between mb-6 pb-2 border-b border-stone-200">
            <div>
                <h2 class="font-serif-title text-xl sm:text-2xl font-bold text-stone-900">Buku Terbaru</h2>
                <p class="text-xs text-stone-500 mt-0.5">Judul-judul pilihan yang baru saja tiba di rak buku kami</p>
            </div>
            <a href="{{ route('books.index') }}" class="text-xs font-medium text-stone-600 hover:text-stone-900">
                Katalog Lengkap &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($latestBooks as $book)
                <div class="bg-white rounded-xl border border-stone-200/90 hover:border-stone-400 transition-all flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Cover Container -->
                        <a href="{{ route('books.show', $book) }}" class="block bg-stone-50 aspect-3/4 relative overflow-hidden border-b border-stone-100">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300" />
                            @else
                                <div class="w-full h-full flex flex-col items-center justify-center p-4 text-center text-stone-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-1 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-[9px] uppercase tracking-wider text-stone-400">{{ $book->category->name }}</span>
                                </div>
                            @endif
                        </a>

                        <!-- Book Info -->
                        <div class="p-3.5 pb-2">
                            <span class="text-[10px] uppercase font-semibold tracking-wider text-stone-400 block mb-1">
                                {{ $book->category->name }}
                            </span>
                            <a href="{{ route('books.show', $book) }}" class="block font-semibold text-stone-900 text-xs sm:text-sm line-clamp-2 leading-snug hover:text-stone-600 transition-colors">
                                {{ $book->title }}
                            </a>
                            <p class="text-[11px] text-stone-500 mt-1 truncate">Oleh: {{ $book->author }}</p>
                        </div>
                    </div>

                    <!-- Book Card Bottom Bar -->
                    <div class="p-3.5 pt-0">
                        <div class="pt-2 border-t border-stone-100 flex items-center justify-between mb-2.5">
                            <span class="text-xs sm:text-sm font-bold text-stone-900">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                            <span class="text-[10px] {{ $book->stock > 0 ? 'text-stone-500' : 'text-rose-600 font-semibold' }}">
                                {{ $book->stock > 0 ? 'Stok: ' . $book->stock : 'Habis' }}
                            </span>
                        </div>

                        <div class="flex gap-1.5">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 py-1.5 rounded-lg border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-medium text-center transition-colors">
                                Detail
                            </a>
                            @if($book->stock > 0)
                                <form action="{{ route('cart.add', $book) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-1.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white text-xs font-medium text-center transition-colors">
                                        + Beli
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-stone-200 p-8">
                    <p class="text-stone-400 text-xs">Belum ada koleksi buku yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Informasi Belanja Ringkas (Bukan AI Card Cliché) -->
    <section class="bg-white border border-stone-200 rounded-xl p-6 sm:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs text-stone-600">
            <div class="space-y-1.5">
                <div class="font-bold text-stone-900 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                    Bayar Tunai di Tempat (COD)
                </div>
                <p class="text-stone-500 leading-relaxed text-[11px]">
                    Belanja nyaman tanpa harus transfer bank terlebih dahulu. Anda cukup membayar uang pas kepada kurir saat pesanan sampai di tangan.
                </p>
            </div>

            <div class="space-y-1.5">
                <div class="font-bold text-stone-900 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                    100% Buku Asli Penerbit
                </div>
                <p class="text-stone-500 leading-relaxed text-[11px]">
                    Seluruh buku bersumber dari penerbit terpercaya dengan kondisi baru, bersegel, dan terjamin orisinalitasnya.
                </p>
            </div>

            <div class="space-y-1.5">
                <div class="font-bold text-stone-900 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                    Pengemasan Aman
                </div>
                <p class="text-stone-500 leading-relaxed text-[11px]">
                    Setiap paket dilapisi pelindung ekstra sehingga buku Anda tidak terlipat atau rusak selama perjalanan pengiriman.
                </p>
            </div>
        </div>
    </section>

</div>
@endsection
