@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold">Kelola Kategori Buku</h1>
            <p class="text-sm text-base-content/70">Daftar semua kategori buku yang tersedia</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">
            + Tambah Kategori
        </a>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200">
            <form action="{{ route('admin.categories.index') }}" method="GET" class="flex gap-2 max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama kategori..." class="input input-sm input-bordered w-full" />
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs">
                        <th class="w-16">No</th>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Total Buku</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td class="font-bold text-xs">{{ $categories->firstItem() + $index }}</td>
                            <td class="font-semibold text-sm">{{ $category->name }}</td>
                            <td class="text-xs text-base-content/60 font-mono">{{ $category->slug }}</td>
                            <td>
                                <span class="badge badge-sm badge-ghost">{{ $category->books_count }} buku</span>
                            </td>
                            <td class="text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-xs btn-outline">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-error text-white">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-base-content/60">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-base-200 flex justify-center">
            {{ $categories->links() }}
        </div>
    </div>
</div>
@endsection
