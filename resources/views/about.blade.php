@extends('layouts.app')

@section('content')
<!-- Header Page Banner -->
<div class="bg-white border-b border-stone-200 py-8 sm:py-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <span class="text-[10px] uppercase font-bold tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
            Profil & Visi Literasi
        </span>
        <h1 class="font-book-title text-3xl sm:text-4xl font-bold text-stone-900 mt-2">Tentang Aksara Pustaka</h1>
        <p class="text-stone-500 text-xs sm:text-sm mt-2 max-w-lg mx-auto leading-relaxed">
            Menghadirkan bacaan berkualitas tinggi dan orisinal untuk mendukung ekosistem literasi cerdas seluruh generasi Indonesia.
        </p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 sm:py-14">
    <div class="bg-white rounded-3xl border border-stone-200 shadow-2xs p-6 sm:p-10 space-y-8">
        
        <!-- Story Section -->
        <div class="space-y-4 text-xs sm:text-sm text-stone-600 leading-relaxed">
            <h2 class="font-book-title text-xl sm:text-2xl font-bold text-stone-900">Dedikasi untuk Budaya Membaca</h2>
            <p>
                <strong class="text-stone-900 font-semibold">Aksara Pustaka</strong> berawal dari semangat sederhana: memastikan setiap pembaca di berbagai pelosok tanah air mendapatkan akses yang mudah, aman, dan terpercaya terhadap buku-buku berbobot.
            </p>
            <p>
                Kami menyajikan karya-karya terbaik dari beragam cabang ilmu—mulai dari teknologi informatika, manajemen bisnis, psikologi, sains populer, hingga sastra klasik dan kontemporer. Setiap buku yang kami sediakan dijamin keasliannya dan tiba dalam kondisi prima tersegel.
            </p>
        </div>

        <!-- 3 Pillars -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 pt-2">
            <div class="p-5 rounded-2xl bg-stone-50 border border-stone-200 text-center space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-bold text-stone-900 text-xs sm:text-sm">100% Asli Bersegel</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">Seluruh buku didistribusikan langsung dari penerbit resmi tanpa barang bajakan.</p>
            </div>

            <div class="p-5 rounded-2xl bg-stone-50 border border-stone-200 text-center space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="font-bold text-stone-900 text-xs sm:text-sm">Bayar di Tempat (COD)</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">Belanja tenang tanpa was-was transfer. Bayar secara tunai saat paket tiba di depan pintu.</p>
            </div>

            <div class="p-5 rounded-2xl bg-stone-50 border border-stone-200 text-center space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-800 flex items-center justify-center mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="font-bold text-stone-900 text-xs sm:text-sm">Pengemasan Berlapis</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">Menggunakan bubble wrap tebal dan kardus pengaman untuk melindungi sudut buku.</p>
            </div>
        </div>

        <div class="pt-6 border-t border-stone-100 text-center">
            <a href="{{ route('books.index') }}" class="px-6 py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors inline-block">
                Jelajahi Koleksi Buku Aksara &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
