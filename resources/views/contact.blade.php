@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="card bg-base-100 shadow-sm border border-base-300 p-6 md:p-8">
        <div class="mb-6">
            <span class="badge badge-primary badge-outline mb-2">Bantuan & Komunikasi</span>
            <h1 class="text-2xl md:text-3xl font-bold">Hubungi Administrator</h1>
            <p class="text-base-content/70 mt-1 text-sm">Kirim pesan, saran, atau pertanyaan Anda langsung kepada pengelola toko.</p>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Pengirim</legend>
                <input type="text" class="input input-bordered w-full bg-base-200" value="{{ auth()->user()->name }} ({{ auth()->user()->email }})" readonly />
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Subjek Pesan</legend>
                <input type="text" name="subject" value="{{ old('subject') }}" class="input input-bordered w-full @error('subject') input-error @enderror" placeholder="Contoh: Pertanyaan seputar ketersediaan stok buku" required />
                @error('subject')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Isi Pesan</legend>
                <textarea name="body" rows="5" class="textarea textarea-bordered w-full @error('body') textarea-error @enderror" placeholder="Tulis pesan lengkap Anda di sini..." required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="pt-2">
                <button type="submit" class="btn btn-primary w-full">Kirim Pesan ke Admin</button>
            </div>
        </form>
    </div>
</div>
@endsection
