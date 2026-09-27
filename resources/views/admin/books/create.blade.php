@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Tambah Buku Baru</h1>
            <p class="text-xs text-stone-500 mt-0.5">Masukkan data buku baru ke dalam katalog Aksara Pustaka</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm text-stone-600 hover:text-stone-900">&larr; Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs p-6 sm:p-8">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="category_id" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Kategori Buku</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700 @error('category_id') border-rose-500 @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Judul Buku</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    value="{{ old('title') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('title') border-rose-500 @enderror" 
                    placeholder="Contoh: Pemrograman Modern Laravel 11" 
                    required 
                />
                @error('title')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="author" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Penulis / Pengarang</label>
                <input 
                    type="text" 
                    id="author" 
                    name="author" 
                    value="{{ old('author') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('author') border-rose-500 @enderror" 
                    placeholder="Nama penulis atau pengarang" 
                    required 
                />
                @error('author')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Harga Buku (Rp)</label>
                    <input 
                        type="number" 
                        id="price" 
                        name="price" 
                        value="{{ old('price') }}" 
                        min="0" 
                        step="1000" 
                        class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('price') border-rose-500 @enderror" 
                        placeholder="95000" 
                        required 
                    />
                    @error('price')
                        <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Kuantitas Stok</label>
                    <input 
                        type="number" 
                        id="stock" 
                        name="stock" 
                        value="{{ old('stock', 10) }}" 
                        min="0" 
                        class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('stock') border-rose-500 @enderror" 
                        required 
                    />
                    @error('stock')
                        <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="cover" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Gambar Sampul (Cover)</label>
                <input 
                    type="file" 
                    id="cover" 
                    name="cover" 
                    accept="image/*" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:border-emerald-700 @error('cover') border-rose-500 @enderror" 
                />
                <p class="text-[10px] text-stone-400 mt-1">Format gambar: JPG, PNG, WEBP (Maksimal 2MB)</p>
                @error('cover')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Deskripsi / Sinopsis Buku</label>
                <textarea 
                    id="description" 
                    name="description" 
                    rows="4" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('description') border-rose-500 @enderror" 
                    placeholder="Ringkasan atau sinopsis buku yang informatif..." 
                    required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-3 flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl shadow-2xs transition-colors">
                    Simpan Buku
                </button>
                <a href="{{ route('admin.books.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
