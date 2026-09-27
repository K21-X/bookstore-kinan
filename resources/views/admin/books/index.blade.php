@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Kelola Buku</h1>
            <p class="text-sm text-base-content/70">Daftar semua koleksi buku dan stok di gudang</p>
        </div>
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">
            + Tambah Buku
        </a>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200">
            <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul / penulis..." class="input input-sm input-bordered w-full sm:w-64" />
                <select name="category_id" class="select select-sm select-bordered w-full sm:w-48">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                @if(request('search') || request('category_id'))
                    <a href="{{ route('admin.books.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs">
                        <th class="w-16">Cover</th>
                        <th>Judul & Penulis</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $book)
                        <tr>
                            <td>
                                <div class="w-12 h-16 bg-base-200 rounded overflow-hidden flex items-center justify-center border border-base-300">
                                    @if($book->cover)
                                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-full object-cover" />
                                    @else
                                        <span class="text-[10px] text-base-content/40 font-bold">NO IMG</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="font-bold text-sm line-clamp-1">{{ $book->title }}</div>
                                <div class="text-xs text-base-content/60">{{ $book->author }}</div>
                            </td>
                            <td>
                                <span class="badge badge-sm badge-outline">{{ $book->category->name }}</span>
                            </td>
                            <td class="font-bold text-sm text-primary">
                                Rp {{ number_format($book->price, 0, ',', '.') }}
                            </td>
                            <td>
                                <span class="badge badge-sm {{ $book->stock > 5 ? 'badge-success text-white' : ($book->stock > 0 ? 'badge-warning' : 'badge-error text-white') }}">
                                    {{ $book->stock }} unit
                                </span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-xs btn-outline">Edit</a>
                                    <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Hapus buku {{ $book->title }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-error text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-base-content/60">Tidak ada buku ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-base-200 flex justify-center">
            {{ $books->links() }}
        </div>
    </div>
</div>
@endsection
