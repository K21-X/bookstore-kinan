@extends('layouts.app')

@section('content')
<!-- Header Halaman Bersih -->
<div class="bg-white border-b border-stone-200 py-6">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2">
            <div>
                <h1 class="font-serif-title text-2xl sm:text-3xl font-bold text-stone-900">
                    Katalog Buku
                </h1>
                <p class="text-xs text-stone-500 mt-1">Daftar seluruh bacaan yang tersedia di Alinea Bookstore</p>
            </div>
            
            <div class="text-xs text-stone-400 flex items-center gap-1.5">
                <a href="{{ route('home') }}" class="hover:text-stone-700 transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-stone-700 font-medium">Katalog</span>
            </div>
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        
        <!-- Sidebar Filter Kiri -->
        <aside class="lg:col-span-3 space-y-5">
            
            <!-- Kotak Filter -->
            <div class="bg-white rounded-xl border border-stone-200 p-4">
                <div class="flex items-center justify-between pb-2.5 mb-3 border-b border-stone-100">
                    <h2 class="font-semibold text-xs text-stone-900">Filter Pencarian</h2>
                    @if(request('search') || request('category'))
                        <a href="{{ route('books.index') }}" class="text-[11px] text-stone-500 hover:text-stone-900 hover:underline">
                            Reset
                        </a>
                    @endif
                </div>

                <form action="{{ route('books.index') }}" method="GET" class="space-y-3.5">
                    <div>
                        <label for="search" class="block text-[11px] font-semibold text-stone-600 mb-1">Cari Judul / Penulis</label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="search" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Ketik kata kunci..." 
                                class="w-full pl-8 pr-3 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium focus:bg-white focus:border-stone-400 outline-none transition-colors" 
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400 absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <div>
                        <label for="category" class="block text-[11px] font-semibold text-stone-600 mb-1">Kategori</label>
                        <select id="category" name="category" class="w-full px-2.5 py-1.5 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium focus:bg-white focus:border-stone-400 outline-none transition-colors">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                                    {{ $cat->name }} ({{ $cat->books_count }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs transition-colors">
                        Terapkan
                    </button>
                </form>
            </div>

            <!-- Daftar Kategori Cepat -->
            <div class="bg-white rounded-xl border border-stone-200 p-4 hidden lg:block">
                <h3 class="font-semibold text-xs text-stone-900 mb-2.5 pb-2 border-b border-stone-100">
                    Kategori Buku
                </h3>
                <div class="space-y-1 text-xs">
                    <a href="{{ route('books.index') }}" class="flex items-center justify-between py-1.5 px-2 rounded-lg transition-colors {{ !request('category') ? 'bg-stone-100 text-stone-900 font-semibold' : 'text-stone-600 hover:bg-stone-50' }}">
                        <span>Semua Koleksi</span>
                        <span class="text-[10px] text-stone-400">{{ $categories->sum('books_count') }}</span>
                    </a>
                    @foreach($categories as $cat)
                        <a href="{{ route('books.index', ['category' => $cat->slug]) }}" class="flex items-center justify-between py-1.5 px-2 rounded-lg transition-colors {{ request('category') === $cat->slug ? 'bg-stone-100 text-stone-900 font-semibold' : 'text-stone-600 hover:bg-stone-50' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="text-[10px] text-stone-400">{{ $cat->books_count }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Catatan Sederhana -->
            <div class="p-3.5 bg-stone-100/70 border border-stone-200 rounded-xl text-xs text-stone-600">
                <span class="font-semibold text-stone-900 block mb-1">Pengiriman COD</span>
                <p class="text-[11px] text-stone-500 leading-relaxed">
                    Setiap judul buku dapat dibayar langsung secara tunai kepada kurir saat buku sampai di alamat Anda.
                </p>
            </div>

        </aside>

        <!-- Area Katalog Utama Kanan -->
        <main class="lg:col-span-9">
            
            <!-- Bar Status Pencarian -->
            <div class="mb-5 flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-3 border-b border-stone-200 text-xs text-stone-600">
                <div>
                    Menampilkan total <strong class="text-stone-900">{{ $books->total() }}</strong> buku
                </div>
                @if(request('search') || request('category'))
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] text-stone-400">Filter:</span>
                        @if(request('search'))
                            <span class="px-2 py-0.5 bg-stone-100 border border-stone-200 rounded text-[11px] text-stone-700">
                                "{{ request('search') }}"
                            </span>
                        @endif
                        @if(request('category'))
                            <span class="px-2 py-0.5 bg-stone-100 border border-stone-200 rounded text-[11px] text-stone-700">
                                {{ request('category') }}
                            </span>
                        @endif
                        <a href="{{ route('books.index') }}" class="text-[11px] text-stone-500 hover:text-stone-900 hover:underline">Hapus Filter</a>
                    </div>
                @endif
            </div>

            <!-- Grid Buku -->
            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-5">
                @forelse($books as $book)
                    <div class="bg-white rounded-xl border border-stone-200/90 hover:border-stone-400 transition-all flex flex-col justify-between overflow-hidden group">
                        <div>
                            <!-- Cover -->
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

                            <!-- Info -->
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

                        <!-- Bottom -->
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
                    <div class="col-span-full py-16 text-center bg-white rounded-xl border border-stone-200 p-8">
                        <p class="text-stone-500 text-sm font-semibold">Buku tidak ditemukan</p>
                        <p class="text-xs text-stone-400 mt-1">Tidak ada koleksi yang sesuai dengan kriteria filter pencarian.</p>
                        <a href="{{ route('books.index') }}" class="inline-block mt-4 px-4 py-2 bg-stone-900 text-white text-xs font-medium rounded-lg hover:bg-stone-800 transition-colors">
                            Lihat Semua Koleksi
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Navigasi Halaman (Pagination) -->
            <div class="mt-8 flex justify-center">
                {{ $books->links() }}
            </div>
        </main>

    </div>
</div>
@endsection
