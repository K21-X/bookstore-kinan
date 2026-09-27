@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Edit Informasi Buku</h1>
            <p class="text-sm text-base-content/70">Perbarui data buku {{ $book->title }}</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Kategori Buku</legend>
                <select name="category_id" class="select select-bordered w-full @error('category_id') select-error @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
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
                <input type="text" name="title" value="{{ old('title', $book->title) }}" class="input input-bordered w-full @error('title') input-error @enderror" required />
                @error('title')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Penulis / Pengarang</legend>
                <input type="text" name="author" value="{{ old('author', $book->author) }}" class="input input-bordered w-full @error('author') input-error @enderror" required />
                @error('author')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Harga (Rp)</legend>
                    <input type="number" name="price" value="{{ old('price', (int)$book->price) }}" min="0" step="1000" class="input input-bordered w-full @error('price') input-error @enderror" required />
                    @error('price')
                        <p class="fieldset-label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Stok</legend>
                    <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" min="0" class="input input-bordered w-full @error('stock') input-error @enderror" required />
                    @error('stock')
                        <p class="fieldset-label text-error">{{ $message }}</p>
                    @enderror
                </fieldset>
            </div>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Gambar Sampul (Cover)</legend>
                @if($book->cover)
                    <div class="mb-2 flex items-center gap-3">
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-16 h-20 object-cover rounded border border-base-300" />
                        <span class="text-xs text-base-content/70">Cover saat ini. Upload file baru jika ingin mengganti.</span>
                    </div>
                @endif
                <input type="file" name="cover" accept="image/*" class="file-input file-input-bordered w-full @error('cover') file-input-error @enderror" />
                <p class="fieldset-label text-xs text-base-content/60">Format: JPG, PNG, WEBP (Maks. 2MB)</p>
                @error('cover')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Deskripsi Lengkap Buku</legend>
                <textarea name="description" rows="5" class="textarea textarea-bordered w-full @error('description') textarea-error @enderror" required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="pt-4 flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.books.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
