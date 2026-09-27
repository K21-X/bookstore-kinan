@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="breadcrumbs text-sm mb-6">
        <ul>
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li><a href="{{ route('books.index') }}">Katalog Buku</a></li>
            <li><a href="{{ route('books.index', ['category' => $book->category->slug]) }}">{{ $book->category->name }}</a></li>
            <li class="font-bold text-primary">{{ $book->title }}</li>
        </ul>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300 p-6 md:p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-base-200 rounded-lg overflow-hidden border border-base-300 flex items-center justify-center min-h-[340px]">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-auto object-cover" />
                    @else
                        <div class="flex flex-col items-center justify-center p-8 text-center text-base-content/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-xs font-semibold uppercase">{{ $book->category->name }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="md:col-span-2 flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <span class="badge badge-primary">{{ $book->category->name }}</span>
                        <span class="badge {{ $book->stock > 0 ? 'badge-outline badge-success' : 'badge-outline badge-error' }}">
                            {{ $book->stock > 0 ? 'Tersedia: ' . $book->stock . ' buku' : 'Stok Habis' }}
                        </span>
                    </div>

                    <h1 class="text-2xl md:text-3xl font-extrabold">{{ $book->title }}</h1>
                    <p class="text-sm text-base-content/70 mt-1">Penulis: <strong class="text-base-content">{{ $book->author }}</strong></p>

                    <div class="text-3xl font-extrabold text-primary mt-4">
                        Rp {{ number_format($book->price, 0, ',', '.') }}
                    </div>

                    <div class="divider my-4"></div>

                    <div>
                        <h2 class="font-bold text-sm text-base-content/70 uppercase tracking-wider mb-2">Deskripsi Buku</h2>
                        <div class="text-base-content/80 text-sm leading-relaxed whitespace-pre-line">
                            {{ $book->description }}
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-base-200">
                    @if($book->stock > 0)
                        <form action="{{ route('cart.add', $book) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4">
                            @csrf
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <label for="qty" class="text-sm font-semibold whitespace-nowrap">Jumlah:</label>
                                <input type="number" id="qty" name="qty" value="1" min="1" max="{{ $book->stock }}" class="input input-bordered w-24 text-center" />
                            </div>
                            <button type="submit" class="btn btn-primary w-full sm:w-auto px-8 gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Tambah ke Keranjang
                            </button>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <span>Maaf, persediaan buku ini sedang habis. Silakan periksa kembali di lain waktu.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="mt-12">
            <h3 class="text-xl font-bold mb-6">Buku Terkait dalam Kategori Serupa</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($relatedBooks as $rel)
                    <div class="card bg-base-100 shadow-sm border border-base-300 p-4">
                        <h4 class="font-bold text-sm line-clamp-1">{{ $rel->title }}</h4>
                        <p class="text-xs text-base-content/70">{{ $rel->author }}</p>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-sm font-bold text-primary">Rp {{ number_format($rel->price, 0, ',', '.') }}</span>
                            <a href="{{ route('books.show', $rel) }}" class="btn btn-xs btn-outline">Lihat</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
