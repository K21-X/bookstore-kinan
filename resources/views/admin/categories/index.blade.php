@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Kategori Buku</h1>
            <p class="text-xs text-stone-500 mt-0.5">Kelola data kategori dan klasifikasi rumpun ilmu buku</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm bg-emerald-800 hover:bg-emerald-900 text-white rounded-xl text-xs font-semibold self-start sm:self-auto">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
        <div class="p-4 border-b border-stone-200 bg-stone-50/50">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2 max-w-sm">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama kategori..." 
                    class="w-full px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700" 
                />
                <button type="submit" class="px-3.5 py-1.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl transition-colors">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                        <th class="py-3 px-6 w-16">No</th>
                        <th class="py-3 px-4">Nama Kategori</th>
                        <th class="py-3 px-4">Slug URL</th>
                        <th class="py-3 px-4">Jumlah Koleksi</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($categories as $index => $category)
                        <tr class="hover:bg-stone-50/60 transition-colors">
                            <td class="py-3.5 px-6 font-bold text-xs text-stone-400">{{ $categories->firstItem() + $index }}</td>
                            <td class="py-3.5 px-4 font-bold text-xs sm:text-sm text-stone-900">{{ $category->name }}</td>
                            <td class="py-3.5 px-4 text-xs text-stone-500 font-mono">{{ $category->slug }}</td>
                            <td class="py-3.5 px-4">
                                <span class="badge badge-sm bg-emerald-50 text-emerald-800 border-emerald-200 font-semibold">{{ $category->books_count }} buku</span>
                            </td>
                            <td class="py-3.5 px-6 text-right">
                                <div class="flex justify-end gap-1.5">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-xs bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg border border-stone-200">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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
                            <td colspan="5" class="text-center py-8 text-xs text-stone-400">Tidak ada kategori yang sesuai ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-stone-200 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
