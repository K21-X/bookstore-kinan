@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold">Katalog Buku</h1>
            <p class="text-base-content/70 text-sm">Temukan berbagai koleksi buku menarik dan bermanfaat</p>
        </div>

        <form action="{{ route('books.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / penulis..." class="input input-bordered w-full sm:w-64" />
            
            <select name="category" class="select select-bordered w-full sm:w-48">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Filter</button>
            @if(request('search') || request('category'))
                <a href="{{ route('books.index') }}" class="btn btn-ghost">Reset</a>
            @endif
        </form>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($books as $book)
            <div class="card bg-base-100 shadow-sm hover:shadow-lg transition-shadow border border-base-300 flex flex-col justify-between">
                <figure class="bg-base-200 h-60 flex items-center justify-center overflow-hidden">
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
            <div class="col-span-full py-16 text-center">
                <div class="max-w-md mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-base-content/30 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <h3 class="text-lg font-bold">Buku Tidak Ditemukan</h3>
                    <p class="text-sm text-base-content/60 mt-1">Coba gunakan kata kunci lain atau reset filter pencarian.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mt-4">Lihat Semua Buku</a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-8 flex justify-center">
        {{ $books->links() }}
    </div>
</div>
@endsection
