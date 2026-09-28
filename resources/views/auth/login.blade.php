@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 sm:py-16">
    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="font-serif-title text-2xl font-bold text-stone-900">Masuk Akun</h1>
            <p class="text-xs text-stone-500 mt-1">Masuk untuk mengelola pesanan atau mengakses panel toko</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label for="email" class="block text-[11px] font-semibold text-stone-600 mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('email') border-rose-500 @enderror" 
                    placeholder="nama@email.com" 
                    required 
                    autofocus 
                />
                @error('email')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[11px] font-semibold text-stone-600 mb-1">Kata Sandi</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('password') border-rose-500 @enderror" 
                    placeholder="••••••••" 
                    required 
                />
                @error('password')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-stone-600">
                    <input type="checkbox" name="remember" class="rounded border-stone-300 text-stone-900" />
                    <span>Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs transition-colors">
                Masuk
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-stone-100 text-center space-y-2">
            <p class="text-xs text-stone-500">
                Belum memiliki akun? <a href="{{ route('register') }}" class="font-semibold text-stone-900 hover:underline">Daftar sekarang</a>
            </p>
            <p class="text-[11px] text-stone-400">
                Bisa memesan buku tanpa akun: <a href="{{ route('books.index') }}" class="text-stone-700 hover:underline font-medium">Katalog Buku</a>
            </p>
        </div>

    </div>
</div>
@endsection
