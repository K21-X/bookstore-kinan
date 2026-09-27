@extends('layouts.admin')

@section('content')
<div class="max-w-xl mx-auto w-full">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Tambah Kategori Baru</h1>
            <p class="text-sm text-base-content/70">Buat klasifikasi kategori baru untuk buku</p>
        </div>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost btn-sm">&larr; Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Kategori</legend>
                <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full @error('name') input-error @enderror" placeholder="Contoh: Pemrograman, Fiksi, Sejarah" required autofocus />
                @error('name')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="pt-4 flex gap-2">
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
