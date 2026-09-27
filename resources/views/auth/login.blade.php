@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12">
    <div class="card bg-base-100 shadow-sm border border-base-300 p-6 md:p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold">Masuk ke Akun</h1>
            <p class="text-xs text-base-content/70 mt-1">Masuk untuk mengakses pesan dan panel toko</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Alamat Email</legend>
                <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full @error('email') input-error @enderror" placeholder="nama@email.com" required autofocus />
                @error('email')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <fieldset class="fieldset">
                <legend class="fieldset-legend">Password</legend>
                <input type="password" name="password" class="input input-bordered w-full @error('password') input-error @enderror" placeholder="••••••••" required />
                @error('password')
                    <p class="fieldset-label text-error">{{ $message }}</p>
                @enderror
            </fieldset>

            <div class="flex items-center justify-between">
                <label class="label cursor-pointer gap-2 p-0">
                    <input type="checkbox" name="remember" class="checkbox checkbox-sm checkbox-primary" />
                    <span class="label-text text-xs">Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="btn btn-primary w-full mt-2">Masuk</button>
        </form>

        <div class="divider my-6 text-xs text-base-content/60">Belum punya akun?</div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-outline btn-block btn-sm">Daftar Akun Baru</a>
            <p class="text-xs text-base-content/60 mt-4">
                Ingin langsung belanja tanpa mendaftar? <a href="{{ route('books.index') }}" class="link link-primary font-bold">Jelajahi Buku</a>
            </p>
        </div>
    </div>
</div>
@endsection
