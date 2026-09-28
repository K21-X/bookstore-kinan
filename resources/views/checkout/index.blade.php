@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 py-8">
    
    <!-- Header Checkout -->
    <div class="mb-6 pb-3 border-b border-stone-200">
        <h1 class="font-serif-title text-2xl font-bold text-stone-900">Checkout Pengiriman</h1>
        <p class="text-xs text-stone-500 mt-0.5">Lengkapi data penerima dan alamat untuk pengiriman pesanan buku Anda</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Area Kiri: Formulir Data -->
            <div class="lg:col-span-8 space-y-5">
                
                <!-- Data Penerima -->
                <div class="bg-white rounded-xl border border-stone-200 p-5 space-y-4">
                    <h2 class="font-semibold text-xs text-stone-900 uppercase tracking-wider pb-2 border-b border-stone-100">
                        1. Informasi Penerima
                    </h2>

                    @auth
                        <div class="p-3.5 rounded-lg bg-stone-50 border border-stone-200 text-xs space-y-1 text-stone-600">
                            <div><span class="text-stone-400">Nama:</span> <strong class="text-stone-800">{{ auth()->user()->name }}</strong></div>
                            <div><span class="text-stone-400">Email:</span> {{ auth()->user()->email }}</div>
                            @if(auth()->user()->phone)
                                <div><span class="text-stone-400">No. HP:</span> {{ auth()->user()->phone }}</div>
                            @endif
                        </div>
                    @else
                        <div class="p-2.5 bg-stone-100 border border-stone-200 rounded-lg text-xs text-stone-600 flex items-center justify-between">
                            <span>Memesan sebagai tamu. Sudah punya akun?</span>
                            <a href="{{ route('login') }}" class="font-semibold text-stone-900 hover:underline">Masuk di sini</a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 pt-1">
                            <div>
                                <label for="guest_name" class="block text-[11px] font-semibold text-stone-600 mb-1">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    id="guest_name" 
                                    name="guest_name" 
                                    value="{{ old('guest_name') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('guest_name') border-rose-500 @enderror" 
                                    placeholder="Nama penerima paket" 
                                    required 
                                />
                                @error('guest_name')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="guest_email" class="block text-[11px] font-semibold text-stone-600 mb-1">Alamat Email</label>
                                <input 
                                    type="email" 
                                    id="guest_email" 
                                    name="guest_email" 
                                    value="{{ old('guest_email') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('guest_email') border-rose-500 @enderror" 
                                    placeholder="nama@email.com" 
                                    required 
                                />
                                @error('guest_email')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="guest_phone" class="block text-[11px] font-semibold text-stone-600 mb-1">Nomor WhatsApp / HP</label>
                                <input 
                                    type="text" 
                                    id="guest_phone" 
                                    name="guest_phone" 
                                    value="{{ old('guest_phone') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('guest_phone') border-rose-500 @enderror" 
                                    placeholder="08xxxxxxxxxx (untuk konfirmasi kurir)" 
                                    required 
                                />
                                @error('guest_phone')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endauth
                </div>

                <!-- Alamat Pengiriman -->
                <div class="bg-white rounded-xl border border-stone-200 p-5 space-y-3">
                    <h2 class="font-semibold text-xs text-stone-900 uppercase tracking-wider pb-2 border-b border-stone-100">
                        2. Alamat Lengkap Pengiriman
                    </h2>

                    <div>
                        <label for="shipping_address" class="block text-[11px] font-semibold text-stone-600 mb-1">Alamat Tujuan Paket</label>
                        <textarea 
                            id="shipping_address" 
                            name="shipping_address" 
                            rows="4" 
                            class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('shipping_address') border-rose-500 @enderror" 
                            placeholder="Sertakan nama jalan, RT/RW, kelurahan, kecamatan, kota/kabupaten, dan patokan..." 
                            required>{{ old('shipping_address', $user->address ?? '') }}</textarea>
                        @error('shipping_address')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Metode Pembayaran -->
                <div class="bg-white rounded-xl border border-stone-200 p-5 space-y-3">
                    <h2 class="font-semibold text-xs text-stone-900 uppercase tracking-wider pb-2 border-b border-stone-100">
                        3. Pembayaran
                    </h2>

                    <div class="p-3.5 rounded-lg border border-stone-300 bg-stone-50/50 flex items-start gap-3">
                        <input type="radio" checked readonly class="mt-0.5 text-stone-900" />
                        <div>
                            <div class="font-semibold text-xs text-stone-900">
                                Bayar di Tempat (COD / Tunai saat Sampai)
                            </div>
                            <p class="text-[11px] text-stone-500 mt-0.5 leading-relaxed">
                                Anda membayar langsung secara tunai kepada kurir saat buku telah sampai di alamat tujuan.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Area Kanan: Ringkasan Pesanan -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-xl border border-stone-200 p-5 space-y-4 sticky top-20">
                    <h3 class="font-semibold text-xs text-stone-900 uppercase tracking-wider pb-2 border-b border-stone-100">
                        Rincian Tagihan
                    </h3>

                    <!-- Daftar Item Singkat -->
                    <div class="space-y-2.5 max-h-52 overflow-y-auto pr-1">
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between text-xs gap-2">
                                <div class="overflow-hidden">
                                    <div class="font-medium text-stone-800 truncate">{{ $item['title'] }}</div>
                                    <div class="text-[11px] text-stone-400">{{ $item['qty'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                </div>
                                <span class="font-semibold text-stone-900 whitespace-nowrap">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-3 border-t border-stone-100 space-y-1.5 text-xs text-stone-600">
                        <div class="flex justify-between">
                            <span>Subtotal Buku:</span>
                            <span class="font-semibold text-stone-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Metode Pembayaran:</span>
                            <span class="text-stone-800">COD</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-stone-100 flex justify-between items-baseline">
                        <span class="text-xs font-semibold text-stone-900">Total Pembayaran:</span>
                        <span class="text-lg font-bold text-stone-900">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="w-full py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs text-center transition-colors">
                        Konfirmasi Pesanan COD &rarr;
                    </button>

                    <p class="text-[11px] text-stone-400 text-center leading-normal">
                        Pesanan akan langsung diproses ke tahap pengemasan.
                    </p>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
