@extends('layouts.app')

@section('content')
<!-- Breadcrumbs Bar -->
<div class="bg-white border-b border-stone-200 py-3.5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-xs text-stone-500 flex items-center gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-emerald-800 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('books.index') }}" class="hover:text-emerald-800 transition-colors">Katalog Buku</a>
            <span>/</span>
            <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="hover:text-emerald-800 transition-colors">{{ $book->category->name }}</a>
            <span>/</span>
            <span class="text-stone-800 font-bold truncate max-w-xs">{{ $book->title }}</span>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    
    <!-- Main Book Product Detail Card -->
    <div class="bg-white rounded-3xl border border-stone-200 p-6 sm:p-10 shadow-2xs mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14">
            
            <!-- Left Column: Book Cover & Badges -->
            <div class="lg:col-span-5 space-y-4">
                <div class="bg-stone-100 rounded-2xl overflow-hidden border border-stone-200 flex items-center justify-center p-4 relative min-h-[380px]">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full max-w-xs h-auto object-cover rounded-xl shadow-md" />
                    @else
                        <div class="text-center p-8 text-stone-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-2 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="text-xs font-bold uppercase tracking-wider">{{ $book->category->name }}</span>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-emerald-800 text-white font-bold text-[10px] uppercase px-2.5 py-1 rounded-full shadow-2xs">
                        100% Original
                    </span>
                </div>

                <!-- Trust Box -->
                <div class="p-4 rounded-2xl bg-stone-50 border border-stone-200 text-xs text-stone-600 space-y-2">
                    <div class="font-bold text-stone-900 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-700"></span>
                        Jaminan Aksara Pustaka
                    </div>
                    <ul class="text-[11px] text-stone-500 space-y-1 list-disc list-inside">
                        <li>Buku bergaransi asli langsung dari penerbit resmi</li>
                        <li>Dapat bayar di tempat (COD) saat barang sampai di rumah</li>
                        <li>Pengemasan aman menggunakan kardus & bubble wrap tebal</li>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Info, Price & Action -->
            <div class="lg:col-span-7 flex flex-col justify-between">
                <div>
                    <!-- Badges -->
                    <div class="flex items-center gap-2 mb-3">
                        <a href="{{ route('books.index', ['category' => $book->category->slug]) }}" class="px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200 hover:bg-emerald-100 transition-colors">
                            {{ $book->category->name }}
                        </a>
                        <span class="px-3 py-1 rounded-full {{ $book->stock > 0 ? 'bg-stone-100 text-stone-700' : 'bg-rose-50 text-rose-700' }} text-xs font-bold">
                            {{ $book->stock > 0 ? 'Stok Tersedia (' . $book->stock . ' buku)' : 'Stok Habis' }}
                        </span>
                    </div>

                    <!-- Book Title -->
                    <h1 class="font-book-title text-2xl sm:text-3xl lg:text-4xl font-bold text-stone-900 tracking-tight leading-tight">
                        {{ $book->title }}
                    </h1>

                    <div class="mt-2 text-xs sm:text-sm text-stone-500">
                        Penulis / Pengarang: <strong class="text-stone-800">{{ $book->author }}</strong>
                    </div>

                    <!-- Price Box -->
                    <div class="my-6 p-5 rounded-2xl bg-stone-50 border border-stone-200 flex items-center justify-between">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-stone-400 block">Harga Buku</span>
                            <span class="text-2xl sm:text-3xl font-extrabold text-emerald-800">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="text-right">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white border border-stone-200 rounded-xl text-xs font-bold text-emerald-800 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-600"></span>
                                COD Tersedia
                            </span>
                        </div>
                    </div>

                    <!-- Synopsis -->
                    <div class="space-y-2 mb-6">
                        <h2 class="text-xs font-bold uppercase tracking-wider text-stone-900">Deskripsi & Sinopsis Buku</h2>
                        <div class="text-xs sm:text-sm text-stone-600 leading-relaxed whitespace-pre-line bg-stone-50/50 p-4 rounded-xl border border-stone-100">
                            {{ $book->description }}
                        </div>
                    </div>
                </div>

                <!-- Add to Cart Form -->
                <div class="pt-6 border-t border-stone-200">
                    @if($book->stock > 0)
                        <form action="{{ route('cart.add', $book) }}" method="POST" class="flex flex-col sm:flex-row items-center gap-4">
                            @csrf
                            <div class="flex items-center gap-2 w-full sm:w-auto">
                                <label for="qty" class="text-xs font-bold uppercase tracking-wider text-stone-600 whitespace-nowrap">Jumlah:</label>
                                <input 
                                    type="number" 
                                    id="qty" 
                                    name="qty" 
                                    value="1" 
                                    min="1" 
                                    max="{{ $book->stock }}" 
                                    class="w-24 px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-center font-bold text-xs outline-none focus:bg-white focus:border-emerald-700 transition-colors" 
                                />
                            </div>
                            <button type="submit" class="w-full sm:w-auto flex-1 py-3 px-6 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs sm:text-sm flex items-center justify-center gap-2 shadow-2xs transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                Masukkan ke Keranjang Belanja
                            </button>
                        </form>
                    @else
                        <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold text-center">
                            Persediaan buku ini sedang habis. Silakan pilih judul buku menarik lainnya di katalog kami.
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Related Books Section -->
    @if(isset($relatedBooks) && $relatedBooks->count() > 0)
        <div class="my-10">
            <h2 class="font-book-title text-xl font-bold text-stone-900 mb-6">
                Buku Terkait dalam Kategori <span class="text-emerald-800">{{ $book->category->name }}</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedBooks as $related)
                    <div class="bg-white rounded-2xl border border-stone-200 hover:border-emerald-700/60 hover:shadow-md transition-all flex flex-col justify-between overflow-hidden group">
                        <div>
                            <div class="bg-stone-100 aspect-3/4 relative flex items-center justify-center overflow-hidden border-b border-stone-100">
                                @if($related->cover)
                                    <img src="{{ asset('storage/' . $related->cover) }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-300" />
                                @else
                                    <div class="p-6 text-center text-stone-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-stone-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-stone-900 text-xs sm:text-sm line-clamp-1 leading-snug group-hover:text-emerald-800 transition-colors">
                                    {{ $related->title }}
                                </h3>
                                <p class="text-xs text-stone-500 mt-1">{{ $related->author }}</p>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <div class="pt-2 border-t border-stone-100 flex items-center justify-between mb-3">
                                <span class="text-sm font-extrabold text-emerald-800">
                                    Rp {{ number_format($related->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <a href="{{ route('books.show', $related) }}" class="block w-full py-2 rounded-xl border border-stone-200 hover:bg-stone-100 text-stone-700 text-xs font-semibold text-center transition-colors">
                                Lihat Buku
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
