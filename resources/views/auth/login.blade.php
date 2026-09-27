@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto px-4 py-12 sm:py-16">
    <div class="bg-white rounded-3xl border border-stone-200 shadow-2xs p-6 sm:p-10">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-12 h-12 rounded-2xl bg-emerald-800 text-white flex items-center justify-center mx-auto mb-3 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900">Masuk ke Akun</h1>
            <p class="text-xs text-stone-500 mt-1">Gunakan akun Anda untuk mengelola toko atau memantau transaksi</p>
        </div>

        

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Alamat Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    class="w-full px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('email') border-rose-500 @enderror" 
                    placeholder="nama@email.com" 
                    required 
                    autofocus 
                />
                @error('email')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Kata Sandi</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="w-full px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('password') border-rose-500 @enderror" 
                    placeholder="••••••••" 
                    required 
                />
                @error('password')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="checkbox checkbox-xs rounded border-stone-300 text-emerald-800" />
                    <span class="text-xs text-stone-600">Ingat saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors">
                Masuk Sekarang
            </button>
        </form>

        <div class="my-6 border-t border-stone-100 text-center relative">
            <span class="bg-white px-3 text-[11px] text-stone-400 font-medium absolute -top-2 left-1/2 -translate-x-1/2">Atau</span>
        </div>

        <div class="text-center space-y-3">
            <a href="{{ route('register') }}" class="block w-full py-2.5 rounded-xl border border-stone-200 hover:bg-stone-50 text-stone-700 text-xs font-semibold transition-colors">
                Daftar Akun Baru
            </a>
            <p class="text-xs text-stone-500">
                Mau pesan tanpa login? <a href="{{ route('books.index') }}" class="text-emerald-800 font-bold hover:underline">Langsung Belanja COD</a>
            </p>
        </div>
    </div>
</div>

<script>
function fillCreds(email, pass) {
    document.getElementById('email').value = email;
    document.getElementById('password').value = pass;
}
</script>
@endsection
