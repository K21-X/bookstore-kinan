@extends('layouts.app')

@section('content')
<!-- Header Page Banner -->
<div class="bg-white border-b border-stone-200 py-6 sm:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                    Katalog Koleksi
                </span>
                <h1 class="font-book-title text-2xl sm:text-3xl font-bold text-stone-900 mt-1.5">
                    Daftar Semua Koleksi Buku
                </h1>
                <p class="text-xs text-stone-500 mt-1">Pilih dan temukan bacaan berkualitas terkurasi dengan sistem pembayaran COD</p>
            </div>
            
            <div class="text-xs text-stone-500 flex items-center gap-2">
                <a href="{{ route('home') }}" class="hover:text-emerald-800 transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-stone-800 font-bold">Katalog Buku</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Left Filter Sidebar -->
        <aside class="lg:col-span-3 space-y-6">
            
            <!-- Filter Form Card -->
            <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs">
                <div class="flex items-center justify-between pb-3 mb-4 border-b border-stone-100">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900">Filter Pencarian</h2>
                    @if(request('search') || request('category'))
                        <a href="{{ route('books.index') }}" class="text-[11px] font-bold text-rose-600 hover:underline">
                            Reset
                        </a>
                    @endif
                </div>

                <form action="{{ route('books.index') }}" method="GET" class="space-y-4">
                    <div>
                        <label for="search" class="block text-[11px] font-bold uppercase tracking-wider text-stone-500 mb-1.5">Kata Kunci</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="search" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Judul atau penulis..." 
                                class="w-full pl-9 pr-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium focus:bg-white focus:border-emerald-700 outline-none transition-colors" 
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-[11px] font-bold uppercase tracking-wider text-stone-500 mb-1.5">Kategori</label>
                        <select id="category" name="category" class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium focus:bg-white focus:border-emerald-700 outline-none transition-colors">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->books_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors">
                        Terapkan Filter
                    </button>
                </form>
            </div>

            <!-- Categories Quick Shelf -->
            <div class="bg-white rounded-2xl border border-stone-200 p-5 shadow-2xs hidden lg:block">
                <h3 class="font-bold text-xs uppercase tracking-wider text-stone-900 mb-3 pb-2 border-b border-stone-100">
                    Kategori Pustaka
                </h3>
                <div class="space-y-1">
                    <a href="{{ route('books.index') }}" class="flex items-center justify-between py-2 px-3 rounded-xl text-xs font-semibold transition-colors {{ !request('category') ? 'bg-emerald-50 text-emerald-900 font-bold' : 'text-stone-600 hover:bg-stone-50' }}">
                        <span>Semua Koleksi</span>
                        <span class="text-[10px] bg-stone-100 px-1.5 py-0.5 rounded text-stone-500">{{ $categories->sum('books_count') }}</span>
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('books.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between py-2 px-3 rounded-xl text-xs font-semibold transition-colors {{ request('category') === $cat->slug ? 'bg-emerald-50 text-emerald-900 font-bold' : 'text-stone-600 hover:bg-stone-50' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="text-[10px] bg-stone-100 px-1.5 py-0.5 rounded text-stone-500">{{ $cat->books_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- COD Notice Card -->
            <div class="p-4 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-xs text-emerald-900 space-y-1.5">
                <div class="font-bold flex items-center gap-1.5 text-emerald-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi Pengiriman COD
                </div>
                <p class="text-[11px] text-emerald-800/90 leading-relaxed">
                    Setiap pesanan buku dapat Anda bayar secara langsung saat kurir tiba di alamat Anda tanpa perlu transfer terlebih dahulu.
                </p>
            </div>

        </aside>

        <!-- Right Main Catalog Area -->
        <main class="lg:col-span-9">
            
            <!-- Result Summary Bar -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white p-4 rounded-2xl border border-stone-200">
                <div class="text-xs text-stone-600">
                    Menampilkan total <strong class="text-stone-900">{{ $books->total() }}</strong> koleksi buku
                </div>
                @if(request('search') || request('category'))
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] text-stone-400">Filter aktif:</span>
                        @if(request('search'))
                            <span class="px-2.5 py-1 bg-stone-100 border border-stone-200 rounded-lg text-[11px] font-semibold text-stone-700">
                                Cari: "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="px-2.5 py-1 bg-emerald-100/70 border border-emerald-200 text-emerald-900 rounded-lg text-[11px] font-semibold">
                                Kategori: {{ request('category') }}
                            </span>
                        @endif
                        <a href="{{ route('books.index') }}" class="text-[11px] text-rose-600 font-bold hover:underline ml-1">Hapus</a>
                    </div>
                @endif
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($books as $book)
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

                            <!-- Info -->
                            <div class="p-4">
                                <h3 class="font-bold text-stone-900 text-xs sm:text-sm line-clamp-2 leading-snug group-hover:text-emerald-800 transition-colors">
                                    {{ $book->title }}
                                </h3>
                                <p class="text-xs text-stone-500 mt-1">Penulis: {{ $book->author }}</p>
                            </div>
                        </div>

                        <!-- Bottom Card -->
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
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-stone-200 p-8">
                        <div class="w-14 h-14 rounded-full bg-stone-100 text-stone-400 flex items-center justify-center mx-auto mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-bold text-stone-900">Koleksi Buku Tidak Ditemukan</h3>
                        <p class="text-xs text-stone-500 mt-1 max-w-sm mx-auto">Tidak ada buku yang sesuai dengan pencarian atau filter yang Anda terapkan.</p>
                        <a href="{{ route('books.index') }}" class="btn btn-sm bg-emerald-800 hover:bg-emerald-900 text-white mt-4 rounded-xl">
                            Reset Semua Filter
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination Container -->
            <div class="mt-10 flex justify-center">
                {{ $books->links() }}
            </div>
        </main>

    </div>
</div>
@endsection
