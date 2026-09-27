@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 sm:py-16">
    <div class="bg-white rounded-3xl border border-stone-200 shadow-2xs p-6 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-emerald-800 text-white flex items-center justify-center mx-auto mb-3 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900">Daftar Akun Baru</h1>
            <p class="text-xs text-stone-500 mt-1">Buat akun untuk kemudahan pemesanan dan pelacakan paket buku Anda</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('name') border-rose-500 @enderror" 
                    placeholder="Contoh: Ahmad Fauzi" 
                    required 
                    autofocus 
                />
                @error('name')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Alamat Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('email') border-rose-500 @enderror" 
                    placeholder="nama@email.com" 
                    required 
                />
                @error('email')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">No. Handphone / WhatsApp (Opsional)</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('phone') border-rose-500 @enderror" 
                    placeholder="081234567890" 
                />
                @error('phone')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Alamat Pengiriman (Opsional)</label>
                <textarea 
                    id="address" 
                    name="address" 
                    rows="2" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('address') border-rose-500 @enderror" 
                    placeholder="Alamat tempat tinggal lengkap...">{{ old('address') }}</textarea>
                @error('address')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Kata Sandi</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('password') border-rose-500 @enderror" 
                    placeholder="Minimal 8 karakter" 
                    required 
                />
                @error('password')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Konfirmasi Kata Sandi</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700" 
                    placeholder="Ulangi kata sandi" 
                    required 
                />
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors mt-2">
                Daftar Akun Sekarang
            </button>
        </form>

        <div class="my-6 border-t border-stone-100 text-center relative">
            <span class="bg-white px-3 text-[11px] text-stone-400 font-medium absolute -top-2 left-1/2 -translate-x-1/2">Sudah punya akun?</span>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="block w-full py-2.5 rounded-xl border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-semibold transition-colors">
                Masuk ke Akun Anda
            </a>
        </div>
    </div>
</div>
@endsection
