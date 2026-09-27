@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <div class="card bg-base-100 shadow-sm border border-base-300 p-8 md:p-12">
        <div class="text-center mb-8">
            <span class="badge badge-primary badge-outline mb-2">Profil Toko</span>
            <h1 class="text-3xl md:text-4xl font-extrabold text-primary">Tentang WahyuStore</h1>
            <p class="text-base-content/70 mt-2">Membuka jendela ilmu pengetahuan melalui buku pilihan berkualitas.</p>
        </div>

        <div class="space-y-6 text-base-content/90 leading-relaxed">
            <p>
                <strong>WahyuStore</strong> didirikan dengan semangat untuk mempermudah akses membaca bagi seluruh masyarakat Indonesia. Kami percaya bahwa setiap lembar buku menyimpan wawasan, inspirasi, dan masa depan yang lebih baik.
            </p>
            <p>
                Kami menyediakan ragam kategori buku mulai dari pemrograman, teknologi modern, literatur novel, manajemen bisnis & finansial, hingga buku pengembangan diri yang ditulis oleh para penulis terkemuka.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-6">
                <div class="card bg-base-200 p-6 text-center">
                    <div class="text-primary font-bold text-lg mb-2">Koleksi Terkurasi</div>
                    <p class="text-sm text-base-content/80">Semua buku yang tersedia telah melalui kurasi mutu dan keaslian konten.</p>
                </div>
                <div class="card bg-base-200 p-6 text-center">
                    <div class="text-primary font-bold text-lg mb-2">Cash on Delivery (COD)</div>
                    <p class="text-sm text-base-content/80">Belanja aman dan nyaman tanpa was-was, bayar saat paket pesanan Anda sampai.</p>
                </div>
                <div class="card bg-base-200 p-6 text-center">
                    <div class="text-primary font-bold text-lg mb-2">Akses Terbuka</div>
                    <p class="text-sm text-base-content/80">Siapapun bisa langsung belanja tanpa harus melalui proses pendaftaran yang rumit.</p>
                </div>
            </div>

            <div class="pt-8 text-center">
                <a href="{{ route('books.index') }}" class="btn btn-primary px-8">Mulai Jelajahi Buku</a>
            </div>
        </div>
    </div>
</div>
@endsection
