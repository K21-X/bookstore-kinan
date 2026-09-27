@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="card bg-base-100 shadow-sm border border-base-300 p-6 md:p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">Daftar Akun Baru</h1>
            <p class="text-xs text-base-content/70 mt-1">Daftarkan akun untuk kemudahan belanja dan kontak admin</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Lengkap</legend>
                <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full @error('name') input-error @enderror" placeholder="Wahyu Pratama" required autofocus />
                @error('name')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Alamat Email</legend>
                <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full @error('email') input-error @enderror" placeholder="nama@email.com" required />
                @error('email')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">No. Handphone (Opsional)</legend>
                <input type="text" name="phone" value="{{ old('phone') }}" class="input input-bordered w-full @error('phone') input-error @enderror" placeholder="081234567890" />
                @error('phone')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Alamat Pengiriman (Opsional)</legend>
                <textarea name="address" rows="2" class="textarea textarea-bordered w-full @error('address') textarea-error @enderror" placeholder="Alamat lengkap tempat tinggal">{{ old('address') }}</textarea>
                @error('address')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password</legend>
                <input type="password" name="password" class="input input-bordered w-full @error('password') input-error @enderror" placeholder="Minimal 8 karakter" required />
                @error('password')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Konfirmasi Password</legend>
                <input type="password" name="password_confirmation" class="input input-bordered w-full" placeholder="Ulangi password" required />
            </fieldset>

            <button type="submit" class="btn btn-primary w-full mt-4">Daftar Sekarang</button>
        </form>

        <div class="divider my-6 text-xs text-base-content/60">Sudah punya akun?</div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-outline btn-block btn-sm">Masuk ke Akun</a>
        </div>
    </div>
</div>
@endsection
