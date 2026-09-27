@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Edit Kategori Buku</h1>
            <p class="text-xs text-stone-500 mt-0.5">Perbarui nama kategori klasifikasi buku</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost btn-sm text-stone-600 hover:text-stone-900">&larr; Kembali</a>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs p-6 sm:p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Nama Kategori</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $category->name) }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-300 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('name') border-rose-500 @enderror" 
                    required 
                    autofocus 
                />
                @error('name')
                    <p class="text-[11px] text-rose-600 mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-700 mb-1.5">Slug URL (Dihasilkan Otomatis)</label>
                <input 
                    type="text" 
                    value="{{ $category->slug }}" 
                    class="w-full px-3 py-2 bg-stone-100 border border-stone-200 text-stone-500 text-xs rounded-xl font-mono" 
                    readonly 
                />
            </div>

            <div class="pt-3 flex gap-2">
                <button type="submit" class="px-5 py-2.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl shadow-2xs transition-colors">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-4 py-2.5 bg-stone-100 hover:bg-stone-200 text-stone-700 font-semibold text-xs rounded-xl transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
