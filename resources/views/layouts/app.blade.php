<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Aksara Pustaka - Toko Buku & Literasi Terpercaya' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:ital,wght@0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .font-book-title {
            font-family: 'Lora', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-stone-50 text-stone-800 antialiased selection:bg-emerald-700 selection:text-white">

    <!-- Top Announcement & Service Bar -->
    <div class="bg-emerald-950 text-emerald-100/90 text-xs py-2 px-4 border-b border-emerald-900 hidden md:block">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="flex items-center gap-4 text-[11px] font-medium">
                <span class="inline-flex items-center gap-1.5 text-emerald-300 font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    Pengiriman COD ke Seluruh Indonesia
                </span>
                <span class="text-emerald-700">•</span>
                <span>Jaminan Buku 100% Original dari Penerbit Resmi</span>
                <span class="text-emerald-700">•</span>
                <span>Kemasan Bubble Wrap Gratis</span>
            </div>
            <div class="flex items-center gap-5 text-[11px] text-emerald-200/80">
                <a href="{{ route('about') }}" class="hover:text-white transition-colors">Tentang Kami</a>
                <a href="{{ route('contact.index') }}" class="hover:text-white transition-colors">Bantuan & CS</a>
                <span>Jam Layanan: 08.00 - 21.00 WIB</span>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header class="bg-white border-b border-stone-200 sticky top-0 z-50 shadow-2xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-18 gap-4">
                
                <!-- Logo & Mobile Drawer Toggle -->
                <div class="flex items-center gap-3">
                    <div class="dropdown lg:hidden">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-sm btn-square text-stone-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content bg-white border border-stone-200 rounded-2xl z-50 mt-3 w-60 p-2 shadow-xl">
                            <li class="menu-title text-[10px] uppercase font-bold text-stone-400 tracking-wider">Navigasi Menu</li>
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active bg-emerald-700 text-white font-bold' : '' }}">Beranda</a></li>
                            <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'active bg-emerald-700 text-white font-bold' : '' }}">Katalog Koleksi Buku</a></li>
                            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active bg-emerald-700 text-white font-bold' : '' }}">Tentang Aksara Pustaka</a></li>
                            <li><a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'active bg-emerald-700 text-white font-bold' : '' }}">Hubungi Admin</a></li>
                        </ul>
                    </div>

                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-800 text-white flex items-center justify-center shadow-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-book-title text-xl font-extrabold text-stone-900 tracking-tight leading-none">Aksara Pustaka</span>
                            <span class="text-[10px] font-semibold text-emerald-800 uppercase tracking-wider mt-0.5">Toko Buku & Literasi</span>
                        </div>
                    </a>
                </div>

                <!-- Integrated Search Form -->
                <div class="hidden md:flex flex-1 max-w-xl mx-4">
                    <form action="{{ route('books.index') }}" method="GET" class="w-full flex items-center">
                        <div class="relative w-full">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Cari judul buku, nama penulis, atau topik bacaan..." 
                                class="w-full pl-10 pr-24 py-2 bg-stone-100 hover:bg-stone-100/80 focus:bg-white border border-stone-300 focus:border-emerald-700 rounded-full text-xs font-medium text-stone-800 placeholder-stone-400 outline-none transition-all shadow-2xs" 
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <button type="submit" class="absolute right-1 top-1 bottom-1 px-3.5 bg-emerald-800 hover:bg-emerald-700 text-white rounded-full text-[11px] font-bold transition-colors">
                                Cari
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Right Actions: Cart & Account -->
                <div class="flex items-center gap-2.5 sm:gap-3">
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = count($cartItems);
                    @endphp

                    <!-- Cart Button with Pill Look -->
                    <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-xl bg-stone-100 hover:bg-stone-200/80 text-stone-800 border border-stone-200 transition-colors" title="Keranjang Belanja">
                        <div class="relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-emerald-700 text-white font-extrabold text-[9px] w-4 h-4 rounded-full flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </div>
                        <span class="text-xs font-bold hidden sm:inline">Keranjang</span>
                    </a>

                    <!-- User Account / Auth Actions -->
                    @auth
                        <div class="dropdown dropdown-end">
                            <div tabindex="0" role="button" class="flex items-center gap-2 p-1.5 pl-2 pr-3 bg-stone-100 hover:bg-stone-200/80 rounded-full border border-stone-200 cursor-pointer transition-colors">
                                <div class="w-7 h-7 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center uppercase">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                                <span class="text-xs font-bold text-stone-800 max-w-[100px] truncate hidden sm:inline">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                            <ul tabindex="0" class="dropdown-content menu bg-white border border-stone-200 rounded-2xl z-50 w-56 p-2 shadow-xl mt-2 text-xs">
                                <li class="menu-title px-3 py-1.5 text-stone-400 font-bold uppercase tracking-wider text-[10px]">
                                    Akun: {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                                </li>
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-800 font-bold py-2 hover:bg-emerald-50 rounded-xl">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                            </svg>
                                            Panel Admin
                                        </a>
                                    </li>
                                    <li class="divider my-1 border-stone-100"></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left text-rose-600 font-semibold py-2 hover:bg-rose-50 rounded-xl flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Keluar Akun
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="flex items-center gap-1.5 sm:gap-2">
                            <a href="{{ route('login') }}" class="text-xs font-bold text-stone-700 hover:text-emerald-800 px-3 py-2 rounded-xl hover:bg-stone-100 transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-xs font-bold bg-emerald-800 hover:bg-emerald-900 text-white px-3.5 py-2 rounded-xl transition-all shadow-xs">
                                Daftar
                            </a>
                        </div>
                    @endauth
                </div>

            </div>
        </div>

        <!-- Tier 2: Category & Quick Links Strip -->
        <nav class="bg-stone-50 border-t border-stone-200/90 hidden md:block">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-10 text-xs">
                    <div class="flex items-center gap-6 font-semibold text-stone-600">
                        <a href="{{ route('home') }}" class="transition-colors py-2 {{ request()->routeIs('home') ? 'text-emerald-800 font-bold border-b-2 border-emerald-800' : 'hover:text-emerald-800' }}">
                            Beranda
                        </a>
                        <a href="{{ route('books.index') }}" class="transition-colors py-2 {{ request()->routeIs('books.*') ? 'text-emerald-800 font-bold border-b-2 border-emerald-800' : 'hover:text-emerald-800' }}">
                            Katalog Buku
                        </a>
                        <a href="{{ route('about') }}" class="transition-colors py-2 {{ request()->routeIs('about') ? 'text-emerald-800 font-bold border-b-2 border-emerald-800' : 'hover:text-emerald-800' }}">
                            Tentang Kami
                        </a>
                        <a href="{{ route('contact.index') }}" class="transition-colors py-2 {{ request()->routeIs('contact.*') ? 'text-emerald-800 font-bold border-b-2 border-emerald-800' : 'hover:text-emerald-800' }}">
                            Hubungi Admin
                        </a>
                    </div>
                    <div class="flex items-center gap-3 text-[11px] text-stone-500 font-medium">
                        <span class="inline-flex items-center gap-1 text-emerald-800 font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            COD Tersedia
                        </span>
                        <span>•</span>
                        <span>Bayar di Rumah saat Buku Sampai</span>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Flash Notifications -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6">
            <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-900 flex items-center gap-3 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs sm:text-sm font-semibold">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 pt-6">
            <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-900 flex items-center gap-3 shadow-2xs">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-xs sm:text-sm font-semibold">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Main Content Injection -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Clean Light Modern Footer -->
    <footer class="bg-stone-100 text-stone-700 border-t border-stone-200 mt-20 pt-12 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- 4 Service Highlights Strip -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pb-10 border-b border-stone-200">
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-stone-200/80 shadow-2xs">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-stone-900">Sistem COD Praktis</div>
                        <div class="text-[11px] text-stone-500">Bayar saat buku tiba</div>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-stone-200/80 shadow-2xs">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-stone-900">100% Asli Bersegel</div>
                        <div class="text-[11px] text-stone-500">Langsung dari penerbit</div>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-stone-200/80 shadow-2xs">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-stone-900">Kemasan Pelindung</div>
                        <div class="text-[11px] text-stone-500">Bubble wrap tebal aman</div>
                    </div>
                </div>

                <div class="flex items-center gap-3 p-3 rounded-xl bg-white border border-stone-200/80 shadow-2xs">
                    <div class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-800 flex items-center justify-center shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-xs font-bold text-stone-900">Pengiriman Cepat</div>
                        <div class="text-[11px] text-stone-500">Siap kirim tiap hari</div>
                    </div>
                </div>
            </div>

            <!-- Footer Main Columns -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-10 border-b border-stone-200">
                <div class="md:col-span-2 space-y-3">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-lg bg-emerald-800 text-white flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <span class="font-book-title text-lg font-bold text-stone-900">Aksara Pustaka</span>
                    </div>
                    <p class="text-xs text-stone-500 leading-relaxed max-w-md">
                        Platform pustaka buku terkurasi dengan menghadirkan bacaan berkualitas dari berbagai cabang ilmu pengetahuan. Mendukung literasi nasional dengan kemudahan sistem Cash On Delivery (COD) tanpa repot transfer.
                    </p>
                    <div class="text-xs text-stone-600 font-medium pt-1">
                        📍 Gudang Literasi: Jl. Aksara No. 12, Pustaka Center • 📞 CS: 0812-3456-7890
                    </div>
                </div>

                <div>
                    <h5 class="text-xs font-bold text-stone-900 uppercase tracking-wider mb-3">Tautan Cepat</h5>
                    <ul class="space-y-2 text-xs text-stone-600 font-medium">
                        <li><a href="{{ route('home') }}" class="hover:text-emerald-800 transition-colors">Beranda Toko</a></li>
                        <li><a href="{{ route('books.index') }}" class="hover:text-emerald-800 transition-colors">Semua Koleksi Buku</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-emerald-800 transition-colors">Keranjang Belanja</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-emerald-800 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-emerald-800 transition-colors">Hubungi Layanan Admin</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="text-xs font-bold text-stone-900 uppercase tracking-wider mb-3">Ketentuan COD</h5>
                    <div class="p-3 bg-white rounded-xl border border-stone-200 text-xs text-stone-600 space-y-1.5">
                        <div class="font-bold text-stone-800 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                            Bayar di Tempat (COD)
                        </div>
                        <p class="text-[11px] text-stone-500 leading-normal">
                            Siapkan uang pas saat kurir tiba di alamat Anda. Anda dapat belanja langsung tanpa keharusan mendaftar akun.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-xs text-stone-500 gap-2">
                <p>&copy; {{ date('Y') }} Aksara Pustaka. Seluruh hak cipta dilindungi.</p>
                <div class="flex items-center gap-3 text-[11px]">
                    <span class="px-2 py-0.5 rounded bg-white border border-stone-200 font-semibold text-stone-600">Sistem Ujian Sertifikasi Web</span>
                    <span class="text-emerald-800 font-bold">Terverifikasi COD</span>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>
