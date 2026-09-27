@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Koleksi Buku</h1>
            <p class="text-xs text-stone-500 mt-0.5">Kelola seluruh katalog buku, informasi pengarang, harga, dan stok gudang</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-sm bg-emerald-800 hover:bg-emerald-900 text-white rounded-xl text-xs font-semibold self-start sm:self-auto">
            + Tambah Buku
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
        <!-- Filter Controls -->
        <div class="p-4 border-b border-stone-200 bg-stone-50/50">
            <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2.5">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari judul / penulis..." 
                    class="w-full sm:w-64 px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700" 
                />
                <select name="category_id" class="w-full sm:w-48 px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-1.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl transition-colors">
                    Filter
                </button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.books.index') }}" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                        <th class="py-3 px-6 w-20">Sampul</th>
                        <th class="py-3 px-4">Judul & Penulis</th>
                        <th class="py-3 px-4">Kategori</th>
                        <th class="py-3 px-4">Harga</th>
                        <th class="py-3 px-4">Stok</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($books as $book)
                        <tr class="hover:bg-stone-50/60 transition-colors">
                            <td class="py-3.5 px-6">
                                <div class="w-12 h-16 bg-stone-100 rounded-lg overflow-hidden flex items-center justify-center border border-stone-200 shadow-2xs">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                    @else
                                        <span class="text-[9px] text-stone-400 font-bold uppercase">NO COVER</span>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                <div class="font-bold text-xs sm:text-sm text-stone-900 line-clamp-1">{{ $book->title }}</div>
                                <div class="text-xs text-stone-500 mt-0.5">{{ $book->author }}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="badge badge-sm bg-stone-100 text-stone-700 border-stone-200 font-semibold">{{ $book->category->name }}</span>
                            </td>
                            <td class="py-3.5 px-4 font-extrabold text-xs text-emerald-800 whitespace-nowrap">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="badge badge-sm {{ $book->stock > 0 ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }} font-bold text-[10px]">
                                    {{ $book->stock > 0 ? $book->stock . ' buku' : 'Habis' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="flex justify-end gap-1.5">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-xs bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg border border-stone-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg border border-rose-200">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-xs text-stone-400">Tidak ada koleksi buku yang sesuai ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-stone-200 flex justify-center">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
