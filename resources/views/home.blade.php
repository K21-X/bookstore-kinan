@extends('layouts.app')

@section('content')
<div class="hero bg-base-100 py-12 md:py-20 border-b border-base-300">
    <div class="hero-content text-center max-w-3xl">
        <div>
            <span class="badge badge-primary badge-outline mb-4">Toko Buku Terlengkap & Terpercaya</span>
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight">
                Temukan Bacaan Terbaik di <span class="text-primary">WahyuStore</span>
            </h1>
            <p class="py-6 text-base-content/80 text-lg leading-relaxed">
                Jelajahi beragam koleksi buku pilihan mulai dari teknologi, pengembangan diri, novel, hingga bisnis. Belanja mudah tanpa repot, bayar langsung saat buku tiba di rumah Anda (Cash On Delivery).
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('books.index') }}" class="btn btn-primary px-8">Lihat Katalog</a>
                <a href="{{ route('about') }}" class="btn btn-outline">Tentang Kami</a>
            </div>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h2 class="text-2xl font-bold">Kategori Pilihan</h2>
        <p class="text-base-content/70">Pilih kategori buku yang ingin Anda pelajari</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-16">
        @foreach($categories as $category)
            <a href="{{ route('books.index', ['category' => $category->slug]) }}" class="card bg-base-100 shadow-sm hover:shadow-md transition-shadow border border-base-300">
                <div class="card-body p-5 flex flex-row items-center justify-between">
                    <div>
                        <h3 class="font-bold text-lg text-primary">{{ $category->name }}</h3>
                        <p class="text-xs text-base-content/70">{{ $category->books_count }} Koleksi</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
        @endforeach
    </div>

    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold">Buku Terbaru</h2>
            <p class="text-base-content/70">Koleksi buku terkini yang baru saja ditambahkan</p>
        </div>
        <a href="{{ route('books.index') }}" class="btn btn-ghost btn-sm text-primary font-bold">
            Lihat Semua &rarr;
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($latestBooks as $book)
            <div class="card bg-base-100 shadow-sm hover:shadow-lg transition-shadow border border-base-300 flex flex-col justify-between">
                <figure class="bg-base-200 h-56 flex items-center justify-center overflow-hidden">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                    @else
                        <div class="flex flex-col items-center justify-center p-6 text-center text-base-content/50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-xs font-semibold uppercase">{{ $book->category->name }}</span>
                        </div>
                    @endif
                </figure>
                <div class="card-body p-5">
                    <span class="badge badge-sm badge-ghost w-fit">{{ $book->category->name }}</span>
                    <h3 class="card-title text-base font-bold line-clamp-2 mt-1">{{ $book->title }}</h3>
                    <p class="text-xs text-base-content/70">{{ $book->author }}</p>
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-lg font-bold text-primary">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                        <span class="text-xs {{ $book->stock > 0 ? 'text-success' : 'text-error' }}">
                            {{ $book->stock > 0 ? 'Stok: ' . $book->stock : 'Habis' }}
                        </span>
                    </div>
                    <div class="card-actions mt-4 flex gap-2">
                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline btn-sm flex-1">Detail</a>
                        @if($book->stock > 0)
                            <form action="{{ route('cart.add', $book) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-sm w-full">Beli</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-base-content/60">
                Belum ada koleksi buku yang ditambahkan.
            </div>
        @endforelse
    </div>
</div>
@endsection
