@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Edit Informasi Buku</h1>
            <p class="text-xs text-stone-500 mt-0.5">Perbarui data buku "{{ $book->title }}"</p>
        </div>
        <a href="{{ route('admin.books.index') }}" class="btn btn-ghost btn-sm text-stone-600 hover:text-stone-900">&larr; Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs p-6 sm:p-8">
        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="category_id" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Kategori Buku</label>
                <select id="category_id" name="category_id" class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700 @error('category_id') border-rose-500 @enderror" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
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
                    value="{{ old('title', $book->title) }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('title') border-rose-500 @enderror" 
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
                    value="{{ old('author', $book->author) }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('author') border-rose-500 @enderror" 
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
                        value="{{ old('price', (int)$book->price) }}" 
                        min="0" 
                        step="1000" 
                        class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('price') border-rose-500 @enderror" 
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
                        value="{{ old('stock', $book->stock) }}" 
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
                <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Gambar Sampul (Cover)</label>
                @if($book->cover)
                    <div class="mb-2 flex items-center gap-3 p-2.5 bg-stone-50 border border-stone-200 rounded-xl">
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-12 h-16 object-cover rounded-lg border border-stone-200" />
                        <span class="text-[11px] text-stone-500">Cover saat ini tersimpan. Pilih file baru di bawah ini hanya jika ingin menggantinya.</span>
                    </div>
                @endif
                <input 
                    type="file" 
                    id="cover" 
                    name="cover" 
                    accept="image/*" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:border-emerald-700 @error('cover') border-rose-500 @enderror" 
                />
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
                    required>{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-3 flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl shadow-2xs transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.books.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
