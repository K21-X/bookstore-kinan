@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-10 sm:py-14">
    
    <div class="border-b border-stone-200 pb-6 mb-8">
        <span class="text-[11px] uppercase font-semibold tracking-wider text-stone-500 block mb-1">Tentang Toko</span>
        <h1 class="font-serif-title text-3xl sm:text-4xl font-bold text-stone-900">Alinea Bookstore</h1>
        <p class="text-stone-500 text-xs sm:text-sm mt-2 max-w-xl leading-relaxed">
            Menyediakan kurasi buku pilihan untuk menemani ruang baca, memperdalam wawasan, dan menumbuhkan kecintaan pada literasi.
        </p>
    </div>

    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-10 space-y-8">
        
        <!-- Cerita & Visi -->
        <div class="space-y-4 text-xs sm:text-sm text-stone-600 leading-relaxed">
            <h2 class="font-serif-title text-xl font-bold text-stone-900">Dedikasi untuk Pembaca</h2>
            <p>
                <strong class="text-stone-900">Alinea</strong> hadir bermula dari keinginan sederhana: menghadirkan akses buku yang terkurasi dan berkualitas bagi siapa saja yang ingin terus belajar dan membaca.
            </p>
            <p>
                Kami memilih setiap judul dengan cermat—mulai dari sastra klasik dan kontemporer, kajian filsafat, sains populer, ekonomi, hingga pengembangan diri. Setiap buku yang kami kirimkan dipastikan orisinal langsung dari penerbit resmi dalam kondisi terbaik.
            </p>
        </div>

        <!-- 3 Poin Nilai Sederhana -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2 border-t border-stone-100">
            <div class="p-4 rounded-lg bg-stone-50 border border-stone-200/80 space-y-1.5">
                <h3 class="font-semibold text-stone-900 text-xs sm:text-sm">Buku 100% Original</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">
                    Kami menolak buku bajakan. Seluruh koleksi berasal langsung dari penerbit resmi dan terjamin keasliannya.
                </p>
            </div>

            <div class="p-4 rounded-lg bg-stone-50 border border-stone-200/80 space-y-1.5">
                <h3 class="font-semibold text-stone-900 text-xs sm:text-sm">Bayar di Tempat (COD)</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">
                    Kemudahan berbelanja tanpa perlu transfer bank. Anda cukup membayar secara tunai saat buku tiba di alamat Anda.
                </p>
            </div>

            <div class="p-4 rounded-lg bg-stone-50 border border-stone-200/80 space-y-1.5">
                <h3 class="font-semibold text-stone-900 text-xs sm:text-sm">Pengemasan Rapi</h3>
                <p class="text-[11px] text-stone-500 leading-relaxed">
                    Setiap pesanan buku dikemas dengan lapisan pelindung agar sudut dan punggung buku tetap mulus hingga tujuan.
                </p>
            </div>
        </div>

        <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
            <span class="text-xs text-stone-500">Ada pertanyaan seputar judul buku?</span>
            <a href="{{ route('contact.index') }}" class="text-xs font-semibold text-stone-900 hover:underline">
                Hubungi Layanan Kami &rarr;
            </a>
        </div>

    </div>
</div>
@endsection
