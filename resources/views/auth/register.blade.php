@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 sm:py-16">
    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        
        <!-- Header -->
        <div class="mb-6 text-center">
            <h1 class="font-serif-title text-2xl font-bold text-stone-900">Daftar Akun</h1>
            <p class="text-xs text-stone-500 mt-1">Buat akun untuk mempermudah pemesanan buku Anda</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
            @csrf

            <div>
                <label for="name" class="block text-[11px] font-semibold text-stone-600 mb-1">Nama Lengkap</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('name') border-rose-500 @enderror" 
                    placeholder="Nama Anda" 
                    required 
                    autofocus 
                />
                @error('name')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

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
                />
                @error('email')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="block text-[11px] font-semibold text-stone-600 mb-1">Nomor WhatsApp / HP (Opsional)</label>
                <input 
                    type="text" 
                    id="phone" 
                    name="phone" 
                    value="{{ old('phone') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('phone') border-rose-500 @enderror" 
                    placeholder="08xxxxxxxxxx" 
                />
                @error('phone')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address" class="block text-[11px] font-semibold text-stone-600 mb-1">Alamat Rumah (Opsional)</label>
                <textarea 
                    id="address" 
                    name="address" 
                    rows="2" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('address') border-rose-500 @enderror" 
                    placeholder="Alamat untuk pengiriman...">{{ old('address') }}</textarea>
                @error('address')
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
                    placeholder="Minimal 8 karakter" 
                    required 
                />
                @error('password')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-[11px] font-semibold text-stone-600 mb-1">Ulangi Kata Sandi</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400" 
                    placeholder="Ketik ulang kata sandi" 
                    required 
                />
            </div>

            <button type="submit" class="w-full py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs transition-colors">
                Daftar Akun
            </button>
        </form>

        <div class="mt-6 pt-4 border-t border-stone-100 text-center">
            <p class="text-xs text-stone-500">
                Sudah memiliki akun? <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline">Masuk</a>
            </p>
        </div>

    </div>
</div>
@endsection
