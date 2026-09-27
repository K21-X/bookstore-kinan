@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Tambah Buku Baru</h1>
            <p class="text-sm text-base-content/70">Masukkan informasi lengkap buku baru</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Kategori Buku</legend>
                <select name="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Judul Buku</legend>
                <input type="text" name="title" value="{{ old('title') }}" class="input input-bordered w-full @error('title') input-error @enderror" placeholder="Judul buku" required />
                @error('title')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Penulis / Pengarang</legend>
                <input type="text" name="author" value="{{ old('author') }}" class="input input-bordered w-full @error('author') input-error @enderror" placeholder="Nama penulis" required />
                @error('author')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Harga (Rp)</legend>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" step="1000" class="input input-bordered w-full @error('price') input-error @enderror" placeholder="95000" required />
                    @error('price')
                        <p class="fieldset-label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Stok</legend>
                    <input type="number" name="stock" value="{{ old('stock', 10) }}" min="0" class="input input-bordered w-full @error('stock') input-error @enderror" required />
                    @error('stock')
                        <p class="fieldset-label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>
            </div>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Gambar Sampul (Cover)</legend>
                <input type="file" name="cover" accept="image/*" class="file-input file-input-bordered w-full @error('cover') file-input-error @enderror" />
                <p class="fieldset-label text-xs text-base-content/60">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                @error('cover')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Deskripsi Lengkap Buku</legend>
                <textarea name="description" rows="5" class="textarea textarea-bordered w-full @error('description') textarea-error @enderror" placeholder="Tulis sinopsis atau deskripsi buku di sini..." required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="pt-4 flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
