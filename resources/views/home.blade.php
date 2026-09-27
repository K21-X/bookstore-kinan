@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Banner Section -->
    <div class="my-6 sm:my-8 rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-teal-950 text-white p-6 sm:p-10 lg:p-12 shadow-sm relative overflow-hidden">
        <!-- Subtle decorative ring -->
        <div class="absolute -right-20 -bottom-20 w-80 h-80 rounded-full border border-emerald-700/30 pointer-events-none"></div>
        <div class="absolute right-40 -top-20 w-60 h-60 rounded-full border border-emerald-700/20 pointer-events-none"></div>

        <div class="relative grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
            <!-- Left Hero Content -->
            <div class="lg:col-span-7 space-y-5 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-800/80 border border-emerald-600/40 text-emerald-200 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    Koleksi Pustaka Terkurasi 2026
                </div>

                <h1 class="font-book-title text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight">
                    Temukan Buku Pilihan untuk Memperkaya <span class="italic text-emerald-300">Cakrawala Ilmu</span>
                </h1>

                <p class="text-emerald-100/80 text-xs sm:text-sm leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Menyediakan ragam karya literatur asli mulai dari teknologi, manajemen bisnis, sains terapan, hingga sastra. Belanja nyaman tanpa khawatir dengan fasilitas bayar di tempat (COD) ke seluruh penjuru Nusantara.
                </p>

                <!-- Search box in hero (Mobile/Tablet Friendly) -->
                <div class="pt-2 max-w-lg mx-auto lg:mx-0">
                    <form action="{{ route('books.index') }}" method="GET" class="flex items-center gap-2 bg-white/10 backdrop-blur-md p-1.5 rounded-2xl border border-white/20">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Cari judul buku, penulis, topik..." 
                            class="w-full bg-transparent px-3 py-2 text-xs text-white placeholder-emerald-200/60 outline-none" 
                        />
                        <button type="submit" class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 font-bold text-xs rounded-xl transition-colors whitespace-nowrap shadow-sm">
                            Cari Koleksi
                        </button>
                    </form>
                </div>

                <!-- Trust Points -->
                <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-4 text-xs text-emerald-200">
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>100% Buku Asli Penerbit</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Bayar Tunai di Rumah (COD)</span>
                    </div>
                    <span>•</span>
                    <div class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Tanpa Wajib Bikin Akun</span>
                    </div>
                </div>
            </div>

            <!-- Right Hero: Featured Spotlight Card -->
            <div class="lg:col-span-5">
                @if($latestBooks->count() > 0)
                    @php $featured = $latestBooks->first(); @endphp
                    <div class="bg-stone-900/90 border border-emerald-800/60 rounded-3xl p-5 sm:p-6 shadow-xl backdrop-blur-xs max-w-sm mx-auto">
                        <div class="flex items-center justify-between pb-3 mb-4 border-b border-stone-800">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-300 bg-emerald-900/50 px-2.5 py-0.5 rounded-full border border-emerald-700/50">
                                Rekomendasi Hari Ini
                            </span>
                            <span class="text-xs text-stone-400">{{ $featured->category->name }}</span>
                        </div>

                        <div class="aspect-4/3 w-full bg-stone-800 rounded-2xl overflow-hidden mb-4 border border-stone-700 flex items-center justify-center relative">
                            @if($featured->cover)
                                <img src="{{ asset('storage/' . $featured->cover) }}" alt="{{ $featured->title }}" class="w-full h-full object-cover" />
                            @else
                                <div class="text-center p-4 text-stone-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-[11px] font-bold uppercase tracking-wider">{{ $featured->category->name }}</span>
                                </div>
                            @endif
                        </div>

                        <h3 class="font-bold text-white text-sm sm:text-base line-clamp-1">{{ $featured->title }}</h3>
                        <p class="text-xs text-stone-400 mt-0.5">Karya: {{ $featured->author }}</p>

                        <div class="mt-4 pt-3 border-t border-stone-800 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-stone-400 block uppercase font-bold">Harga Buku</span>
                                <span class="text-base font-extrabold text-emerald-400">Rp {{ number_format($featured->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('books.show', $featured) }}" class="px-3 py-1.5 rounded-xl bg-stone-800 hover:bg-stone-700 text-stone-200 text-xs font-semibold border border-stone-700 transition-colors">
                                    Detail
                                </a>
                                @if($featured->stock > 0)
                                    <form action="{{ route('cart.add', $featured) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3.5 py-1.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold transition-colors">
                                            + Beli
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Category Explorer -->
    <div class="my-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-book-title text-xl sm:text-2xl font-bold text-stone-900">Jelajahi Berdasarkan Kategori</h2>
                <p class="text-xs text-stone-500 mt-0.5">Pilih bidang bacaan sesuai dengan minat dan kebutuhan belajar Anda</p>
            </div>
            <a href="{{ route('books.index') }}" class="text-xs font-bold text-emerald-800 hover:underline hidden sm:inline-flex items-center gap-1">
                Semua Kategori &rarr;
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($categories as $category)
                <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="group p-4 rounded-2xl bg-white border border-stone-200 hover:border-emerald-700 hover:shadow-sm transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 group-hover:bg-emerald-800 text-emerald-800 group-hover:text-white flex items-center justify-center mb-3 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-xs sm:text-sm text-stone-900 group-hover:text-emerald-800 transition-colors">
                            {{ $category->name }}
                        </h3>
                    </div>
                    <div class="mt-3 pt-2.5 border-t border-stone-100 flex items-center justify-between text-[11px] text-stone-500">
                        <span>{{ $category->books_count }} Koleksi</span>
                        <span class="group-hover:translate-x-1 transition-transform text-emerald-800 font-bold">&rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- How COD Works (Belanja Tenang 3 Langkah) -->
    <div class="my-12 p-6 sm:p-8 rounded-3xl bg-stone-100 border border-stone-200">
        <div class="text-center max-w-xl mx-auto mb-6">
            <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-800 bg-emerald-100/60 px-2.5 py-1 rounded-full">
                Kemudahan Transaksi
            </span>
            <h2 class="font-book-title text-lg sm:text-2xl font-bold text-stone-900 mt-2">Belanja Buku COD dalam 3 Langkah</h2>
            <p class="text-xs text-stone-500 mt-1">Tanpa perlu transfer bank, pembayaran dilakukan saat barang sampai di tangan Anda</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-5 rounded-2xl border border-stone-200/80 text-center space-y-2">
                <div class="w-8 h-8 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center mx-auto">1</div>
                <h4 class="font-bold text-xs sm:text-sm text-stone-900">Pilih Buku</h4>
                <p class="text-[11px] text-stone-500 leading-relaxed">Cari dan pilih koleksi buku berkualitas yang ingin Anda baca ke dalam keranjang.</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-stone-200/80 text-center space-y-2">
                <div class="w-8 h-8 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center mx-auto">2</div>
                <h4 class="font-bold text-xs sm:text-sm text-stone-900">Isi Alamat Pengiriman</h4>
                <p class="text-[11px] text-stone-500 leading-relaxed">Masukkan alamat rumah tujuan tanpa keharusan mendaftar akun sebelumnya.</p>
            </div>

            <div class="bg-white p-5 rounded-2xl border border-stone-200/80 text-center space-y-2">
                <div class="w-8 h-8 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center mx-auto">3</div>
                <h4 class="font-bold text-xs sm:text-sm text-stone-900">Bayar Tunai di Rumah</h4>
                <p class="text-[11px] text-stone-500 leading-relaxed">Kurir mengantar paket pesanan Anda, serahkan uang pas sesuai nilai tagihan.</p>
            </div>
        </div>
    </div>

    <!-- Latest Books Catalog Grid -->
    <div class="my-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="font-book-title text-xl sm:text-2xl font-bold text-stone-900">Koleksi Buku Terbaru</h2>
                <p class="text-xs text-stone-500 mt-0.5">Buku rilis terbaru yang siap melengkapi rak bacaan Anda</p>
            </div>
            <a href="{{ route('books.index') }}" class="text-xs font-bold text-emerald-800 hover:underline inline-flex items-center gap-1">
                Katalog Lengkap &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($latestBooks as $book)
                <div class="bg-white rounded-2xl border border-stone-200 hover:border-emerald-700/60 hover:shadow-md transition-all flex flex-col justify-between overflow-hidden group">
                    <div>
                        <!-- Cover Container -->
                        <div class="bg-stone-100 aspect-3/4 relative flex items-center justify-center overflow-hidden border-b border-stone-100">
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-300" />
                            @else
                                <div class="p-6 text-center text-stone-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                    <span class="text-[9px] font-bold uppercase tracking-wider text-stone-400">{{ $book->category->name }}</span>
                                </div>
                            @endif
                            <span class="absolute top-2.5 left-2.5 bg-white/95 text-stone-700 font-bold text-[9px] uppercase px-2 py-0.5 rounded-full border border-stone-200 shadow-2xs">
                                {{ $book->category->name }}
                            </span>
                        </div>

                        <!-- Book Info -->
                        <div class="p-4">
                            <h3 class="font-bold text-stone-900 text-xs sm:text-sm line-clamp-2 leading-snug group-hover:text-emerald-800 transition-colors">
                                {{ $book->title }}
                            </h3>
                            <p class="text-xs text-stone-500 mt-1">Penulis: {{ $book->author }}</p>
                        </div>
                    </div>

                    <!-- Book Card Bottom Bar -->
                    <div class="p-4 pt-0">
                        <div class="pt-2.5 border-t border-stone-100 flex items-center justify-between mb-3">
                            <span class="text-sm sm:text-base font-extrabold text-emerald-800">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                            <span class="text-[10px] font-bold {{ $book->stock > 0 ? 'text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded' : 'text-rose-700 bg-rose-50 px-2 py-0.5 rounded' }}">
                                {{ $book->stock > 0 ? 'Stok: ' . $book->stock : 'Habis' }}
                            </span>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('books.show', $book) }}" class="flex-1 py-2 rounded-xl border border-stone-200 hover:bg-stone-100 text-stone-700 text-xs font-semibold text-center transition-colors">
                                Detail
                            </a>
                            @if($book->stock > 0)
                                <form action="{{ route('cart.add', $book) }}" method="POST" class="flex-1">
                                    @csrf
                                    <button type="submit" class="w-full py-2 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white text-xs font-bold text-center transition-colors shadow-2xs">
                                        + Beli
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-stone-200 p-8">
                    <p class="text-stone-400 text-xs">Belum ada koleksi buku yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
