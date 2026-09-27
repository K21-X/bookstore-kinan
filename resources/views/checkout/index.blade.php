@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold">Checkout & Pengiriman</h1>
        <p class="text-sm text-base-content/70">Lengkapi informasi pengiriman untuk menyelesaikan pesanan Anda</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-6">
                <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                    <h2 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <span class="badge badge-primary">1</span> Informasi Pembeli
                    </h2>

                    @auth
                        <div class="bg-base-200 p-4 rounded-lg space-y-1 text-sm">
                            <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                            @if(auth()->user()->phone)
                                <p><strong>No. HP:</strong> {{ auth()->user()->phone }}</p>
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info py-2 text-xs mb-4">
                            <span>Anda berbelanja sebagai tamu (Guest). Ingin riwayat pesanan tercatat di akun? <a href="{{ route('login') }}" class="link font-bold">Masuk di sini</a></span>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Nama Lengkap</legend>
                                <input type="text" name="guest_name" value="{{ old('guest_name') }}" class="input input-bordered w-full @error('guest_name') input-error @enderror" placeholder="Nama penerima" required />
                                @error('guest_name')
                                    <p class="fieldset-label text-error">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="fieldset-legend">Email</legend>
                                <input type="email" name="guest_email" value="{{ old('guest_email') }}" class="input input-bordered w-full @error('guest_email') input-error @enderror" placeholder="email@domain.com" required />
                                @error('guest_email')
                                    <p class="fieldset-label text-error">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <fieldset class="fieldset sm:col-span-2">
                                <legend class="fieldset-legend">No. Handphone / WhatsApp</legend>
                                <input type="text" name="guest_phone" value="{{ old('guest_phone') }}" class="input input-bordered w-full @error('guest_phone') input-error @enderror" placeholder="08xxxxxxxxxx" required />
                                @error('guest_phone')
                                    <p class="fieldset-label text-error">{{ $message }}</p>
                                @enderror
                            </fieldset>
                        </div>
                    @endauth
                </div>

                <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                    <h2 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <span class="badge badge-primary">2</span> Alamat Pengiriman
                    </h2>

                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Alamat Lengkap Tujuan</legend>
                        <textarea name="shipping_address" rows="3" class="textarea textarea-bordered w-full @error('shipping_address') textarea-error @enderror" placeholder="Jalan, RT/RW, No. Rumah, Kelurahan, Kecamatan, Kota/Kabupaten, Kode Pos" required>{{ old('shipping_address', auth()->user()->address ?? '') }}</textarea>
                        @error('shipping_address')
                            <p class="fieldset-label text-error">{{ $message }}</p>
                        @enderror
                    </fieldset>
                </div>

                <div class="card bg-base-100 shadow-sm border border-base-300 p-6">
                    <h2 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <span class="badge badge-primary">3</span> Metode Pembayaran
                    </h2>

                    <div class="border border-primary bg-primary/5 p-4 rounded-lg flex items-start gap-3">
                        <input type="radio" name="payment_method" value="cod" class="radio radio-primary mt-1" checked />
                        <div>
                            <div class="font-bold text-base">Cash on Delivery (COD)</div>
                            <div class="text-xs text-base-content/70 mt-1">
                                Bayar tunai kepada kurir saat buku telah sampai di alamat tujuan Anda. Aman, praktis, dan tanpa repot transfer.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="card bg-base-100 shadow-sm border border-base-300 p-6 sticky top-20">
                    <h2 class="font-bold text-lg mb-4">Pesanan Anda</h2>

                    <div class="divide-y divide-base-200 text-sm max-h-60 overflow-y-auto mb-4">
                        @foreach($cart as $item)
                            <div class="py-2 flex justify-between gap-2">
                                <div>
                                    <div class="font-semibold line-clamp-1">{{ $item['title'] }}</div>
                                    <div class="text-xs text-base-content/60">{{ $item['qty'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                </div>
                                <div class="font-bold whitespace-nowrap text-right">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-base-300 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between font-extrabold text-base">
                            <span>Total Tagihan:</span>
                            <span class="text-primary text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-full mt-6 text-base">
                        Konfirmasi & Buat Pesanan
                    </button>
                    
                    <a href="{{ route('cart.index') }}" class="btn btn-ghost btn-sm w-full mt-2">
                        Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
