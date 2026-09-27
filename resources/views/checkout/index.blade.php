@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
    
    <!-- Steps Indicator -->
    <div class="mb-8 flex items-center justify-center">
        <div class="flex items-center gap-2 sm:gap-4 text-xs font-semibold">
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">✓</span>
                <span class="hidden sm:inline">Keranjang</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-emerald-800"></div>
            <div class="flex items-center gap-2 text-emerald-800 font-bold">
                <span class="w-6 h-6 rounded-full bg-emerald-800 text-white flex items-center justify-center text-xs">2</span>
                <span>Checkout COD</span>
            </div>
            <div class="w-8 sm:w-16 h-0.5 bg-stone-200"></div>
            <div class="flex items-center gap-2 text-stone-400">
                <span class="w-6 h-6 rounded-full bg-stone-200 text-stone-600 flex items-center justify-center text-xs">3</span>
                <span class="hidden sm:inline">Pesanan Selesai</span>
            </div>
        </div>
    </div>

    <!-- Header Area -->
    <div class="mb-8">
        <h1 class="font-book-title text-2xl sm:text-3xl font-bold text-stone-900">Checkout Pengiriman Buku</h1>
        <p class="text-xs text-stone-500 mt-0.5">Lengkapi alamat pengiriman untuk proses pengiriman paket buku Anda</p>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Area: Form Data Pengiriman -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Section 1: Data Penerima -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-2xs space-y-4">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900 flex items-center gap-2 pb-3 border-b border-stone-100">
                        <span class="w-5 h-5 rounded-full bg-emerald-800 text-white text-[11px] font-bold flex items-center justify-center">1</span>
                        <span>Informasi Penerima Paket</span>
                    </h2>

                    @auth
                        <div class="p-4 rounded-xl bg-stone-50 border border-stone-200 text-xs space-y-1.5 text-stone-600">
                            <div><strong>Nama Penerima:</strong> {{ auth()->user()->name }}</div>
                            <div><strong>Alamat Email:</strong> {{ auth()->user()->email }}</div>
                            @if(auth()->user()->phone)
                                <div><strong>No. Handphone / WhatsApp:</strong> {{ auth()->user()->phone }}</div>
                            @endif
                        </div>
                    @else
                        <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-xs text-emerald-900 flex items-center justify-between">
                            <span>Berbelanja sebagai tamu (guest)? Anda bisa langsung pesan tanpa daftar.</span>
                            <a href="{{ route('login') }}" class="font-bold text-emerald-800 hover:underline">Masuk Akun</a>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                            <div>
                                <label for="guest_name" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Nama Lengkap</label>
                                <input 
                                    type="text" 
                                    id="guest_name" 
                                    name="guest_name" 
                                    value="{{ old('guest_name') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('guest_name') border-rose-500 @enderror" 
                                    placeholder="Contoh: Budi Santoso" 
                                    required 
                                />
                                @error('guest_name')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="guest_email" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Alamat Email</label>
                                <input 
                                    type="email" 
                                    id="guest_email" 
                                    name="guest_email" 
                                    value="{{ old('guest_email') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('guest_email') border-rose-500 @enderror" 
                                    placeholder="nama@email.com" 
                                    required 
                                />
                                @error('guest_email')
                                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="guest_phone" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">No. Handphone / WhatsApp</label>
                                <input 
                                    type="text" 
                                    id="guest_phone" 
                                    name="guest_phone" 
                                    value="{{ old('guest_phone') }}" 
                                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('guest_phone') border-rose-500 @enderror" 
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

                <!-- Section 2: Alamat Pengiriman -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-2xs space-y-4">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900 flex items-center gap-2 pb-3 border-b border-stone-100">
                        <span class="w-5 h-5 rounded-full bg-emerald-800 text-white text-[11px] font-bold flex items-center justify-center">2</span>
                        <span>Alamat Lengkap Pengiriman</span>
                    </h2>

                    <div>
                        <label for="shipping_address" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Alamat Tujuan Pengiriman</label>
                        <textarea 
                            id="shipping_address" 
                            name="shipping_address" 
                            rows="4" 
                            class="w-full px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('shipping_address') border-rose-500 @enderror" 
                            placeholder="Tuliskan nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, dan kode pos tujuan..." 
                            required>{{ old('shipping_address', $user->address ?? '') }}</textarea>
                        @error('shipping_address')
                            <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-[11px] text-stone-400 mt-1">Pastikan alamat selengkap mungkin agar kurir dapat menemukan lokasi dengan cepat.</p>
                    </div>
                </div>

                <!-- Section 3: Metode Pembayaran -->
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-2xs space-y-4">
                    <h2 class="font-bold text-xs sm:text-sm text-stone-900 flex items-center gap-2 pb-3 border-b border-stone-100">
                        <span class="w-5 h-5 rounded-full bg-emerald-800 text-white text-[11px] font-bold flex items-center justify-center">3</span>
                        <span>Metode Pembayaran</span>
                    </h2>

                    <div class="p-4 rounded-xl border-2 border-emerald-800 bg-emerald-50/50 flex items-start gap-3">
                        <input type="radio" checked readonly class="radio radio-success radio-xs mt-1" />
                        <div>
                            <div class="font-bold text-xs text-stone-900 flex items-center gap-2">
                                <span>Bayar di Tempat (Cash on Delivery / COD)</span>
                                <span class="badge badge-xs bg-emerald-800 text-white">Default</span>
                            </div>
                            <p class="text-[11px] text-stone-500 mt-1 leading-relaxed">
                                Anda membayar secara tunai langsung kepada kurir saat buku telah sampai di alamat pengiriman Anda. Tanpa risiko, aman dan terpercaya!
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Area: Order Summary Sticky Card -->
            <div class="lg:col-span-4">
                <div class="bg-white rounded-2xl border border-stone-200 p-6 shadow-2xs space-y-4 sticky top-24">
                    <h3 class="font-bold text-sm text-stone-900 pb-3 border-b border-stone-100">
                        Rincian Pesanan
                    </h3>

                    <!-- Mini items list -->
                    <div class="space-y-3 max-h-60 overflow-y-auto pr-1">
                        @foreach($cart as $item)
                            <div class="flex items-center justify-between text-xs gap-3">
                                <div class="overflow-hidden">
                                    <div class="font-semibold text-stone-800 truncate">{{ $item['title'] }}</div>
                                    <div class="text-[11px] text-stone-400">{{ $item['qty'] }}x @ Rp {{ number_format($item['price'], 0, ',', '.') }}</div>
                                </div>
                                <span class="font-bold text-stone-900 whitespace-nowrap">
                                    Rp {{ number_format($item['price'] * $item['qty'], 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-3 border-t border-stone-100 space-y-2 text-xs text-stone-600">
                        <div class="flex justify-between">
                            <span>Subtotal Buku:</span>
                            <span class="font-bold text-stone-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Layanan COD:</span>
                            <span class="text-emerald-800 font-bold">Gratis</span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-stone-100 flex justify-between items-baseline">
                        <span class="text-xs font-bold text-stone-900">Total Tagihan COD:</span>
                        <span class="text-xl font-extrabold text-emerald-800">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <button type="submit" class="w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors">
                        Buat Pesanan COD Sekarang &rarr;
                    </button>

                    <p class="text-[11px] text-stone-400 text-center leading-normal">
                        Dengan menekan tombol di atas, pesanan Anda akan segera diproses untuk pengiriman.
                    </p>
                </div>
            </div>

        </div>
    </form>

</div>
@endsection
