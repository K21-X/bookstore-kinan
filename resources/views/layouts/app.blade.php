<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Alinea - Toko Buku & Pustaka' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,500;0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v4 & DaisyUI via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #faf9f6;
            color: #292524;
        }
        .font-serif-title {
            font-family: 'Lora', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-stone-800 selection:text-white">

    <!-- Header Bersih & Minimalis (Single Navigation Bar) -->
    <header class="bg-white border-b border-stone-200 sticky top-0 z-40">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16 gap-4">
                
                <!-- Logo & Nav Kiri -->
                <div class="flex items-center gap-8">
                    <!-- Brand -->
                    <a href="{{ route('home') }}" class="flex items-baseline gap-2">
                        <span class="font-serif-title text-2xl font-bold tracking-tight text-stone-900">Alinea</span>
                        <span class="text-[10px] uppercase font-semibold tracking-wider text-stone-400 hidden sm:inline">Pustaka</span>
                    </a>

                    <!-- Nav Desktop Links -->
                    <nav class="hidden md:flex items-center gap-6 text-xs font-medium text-stone-600">
                        <a href="{{ route('books.index') }}" class="hover:text-stone-900 transition-colors {{ request()->routeIs('books.*') ? 'text-stone-900 font-semibold' : '' }}">
                            Katalog Buku
                        </a>
                        <a href="{{ route('about') }}" class="hover:text-stone-900 transition-colors {{ request()->routeIs('about') ? 'text-stone-900 font-semibold' : '' }}">
                            Tentang Kami
                        </a>
                        <a href="{{ route('contact.index') }}" class="hover:text-stone-900 transition-colors {{ request()->routeIs('contact.*') ? 'text-stone-900 font-semibold' : '' }}">
                            Hubungi Kami
                        </a>
                    </nav>
                </div>

                <!-- Bagian Kanan: Pencarian, Keranjang, Akun -->
                <div class="flex items-center gap-3">
                    
                    <!-- Search Bar Ringkas -->
                    <form action="{{ route('books.index') }}" method="GET" class="relative hidden sm:block w-48 md:w-56">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari buku atau penulis..." 
                            class="w-full pl-8 pr-3 py-1.5 bg-stone-100 hover:bg-stone-100/80 focus:bg-white border border-stone-200 focus:border-stone-400 rounded-lg text-xs text-stone-800 placeholder-stone-400 outline-none transition-all"
                        />
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400 absolute left-2.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>

                    <!-- Tombol Keranjang -->
                    @php
                        $cartItems = session()->get('cart', []);
                        $cartCount = count($cartItems);
                    @endphp
                    <a href="{{ route('cart.index') }}" class="relative p-2 rounded-lg text-stone-700 hover:text-stone-900 hover:bg-stone-100 transition-colors" title="Keranjang Belanja">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        @if($cartCount > 0)
                            <span class="absolute top-1 right-1 bg-stone-900 text-white font-bold text-[9px] w-4 h-4 rounded-full flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Autentikasi / Profil -->
                    @auth
                        <div class="dropdown dropdown-end">
                            <button tabindex="0" class="flex items-center gap-2 p-1 pl-2 pr-2.5 rounded-lg border border-stone-200 text-stone-800 hover:bg-stone-100 transition-colors text-xs font-medium cursor-pointer">
                                <span class="w-6 h-6 rounded-full bg-stone-800 text-white font-semibold text-[11px] flex items-center justify-center uppercase">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </span>
                                <span class="max-w-[100px] truncate hidden sm:inline">{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul tabindex="0" class="dropdown-content menu bg-white border border-stone-200 rounded-xl z-50 w-52 p-2 shadow-lg mt-2 text-xs">
                                <li class="menu-title px-3 py-1 text-stone-400 text-[10px] uppercase font-bold tracking-wider">
                                    {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Pelanggan' }}
                                </li>
                                @if(auth()->user()->role === 'admin')
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" class="font-medium text-stone-800 hover:bg-stone-100 rounded-lg py-2">
                                            Panel Admin
                                        </a>
                                    </li>
                                    <li class="divider my-1 border-stone-100"></li>
                                @endif
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                                        @csrf
                                        <button type="submit" class="w-full text-left text-rose-600 hover:bg-rose-50 rounded-lg py-2 font-medium">
                                            Keluar Akun
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="flex items-center gap-1">
                            <a href="{{ route('login') }}" class="text-xs font-medium text-stone-600 hover:text-stone-900 px-3 py-1.5 rounded-lg hover:bg-stone-100 transition-colors">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="text-xs font-semibold bg-stone-900 hover:bg-stone-800 text-white px-3 py-1.5 rounded-lg transition-colors shadow-xs">
                                Daftar
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Dropdown -->
                    <div class="dropdown dropdown-end md:hidden">
                        <button tabindex="0" class="p-2 rounded-lg text-stone-700 hover:bg-stone-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                        <ul tabindex="0" class="dropdown-content menu bg-white border border-stone-200 rounded-xl z-50 mt-2 w-52 p-2 shadow-lg text-xs font-medium">
                            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'font-bold' : '' }}">Beranda</a></li>
                            <li><a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'font-bold' : '' }}">Katalog Buku</a></li>
                            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'font-bold' : '' }}">Tentang Kami</a></li>
                            <li><a href="{{ route('contact.index') }}" class="{{ request()->routeIs('contact.*') ? 'font-bold' : '' }}">Hubungi Kami</a></li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <!-- Notifikasi Flash -->
    @if(session('success'))
        <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 pt-4">
            <div class="p-3.5 rounded-xl bg-stone-100 border border-stone-300 text-stone-800 flex items-center justify-between text-xs font-medium">
                <div class="flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-6xl mx-auto w-full px-4 sm:px-6 pt-4">
            <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 flex items-center gap-2.5 text-xs font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <!-- Konten Utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Sederhana & Bersih -->
    <footer class="bg-white border-t border-stone-200 mt-16 pt-12 pb-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-10 border-b border-stone-200 text-xs">
                
                <!-- Info Brand -->
                <div class="md:col-span-2 space-y-3">
                    <span class="font-serif-title text-xl font-bold tracking-tight text-stone-900 block">Alinea</span>
                    <p class="text-stone-500 leading-relaxed max-w-sm">
                        Toko buku kurasi dengan ragam bacaan sastra, sains, bisnis, dan humaniora. Menyediakan kemudahan pemesanan langsung dengan sistem bayar di tempat (COD).
                    </p>
                    <div class="text-stone-500 text-[11px] pt-1">
                        Gudang & Layanan: Jl. Aksara No. 12 • Jam Buka: 08.00 - 21.00 WIB
                    </div>
                </div>

                <!-- Navigasi -->
                <div>
                    <h4 class="font-semibold text-stone-900 uppercase tracking-wider text-[11px] mb-3">Tautan</h4>
                    <ul class="space-y-2 text-stone-600">
                        <li><a href="{{ route('home') }}" class="hover:text-stone-900 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('books.index') }}" class="hover:text-stone-900 transition-colors">Katalog Buku</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-stone-900 transition-colors">Keranjang</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-stone-900 transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact.index') }}" class="hover:text-stone-900 transition-colors">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Layanan COD -->
                <div>
                    <h4 class="font-semibold text-stone-900 uppercase tracking-wider text-[11px] mb-3">Informasi Pembelian</h4>
                    <p class="text-stone-500 leading-relaxed mb-2">
                        Belanja tanpa perlu transfer. Anda dapat langsung memesan buku dan membayar secara tunai saat buku tiba di alamat Anda.
                    </p>
                    <div class="text-[11px] text-stone-600 font-medium">
                        Pengemasan aman & buku 100% original.
                    </div>
                </div>

            </div>

            <!-- Hak Cipta -->
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-between text-[11px] text-stone-400 gap-2">
                <p>&copy; {{ date('Y') }} Alinea Bookstore. Seluruh hak cipta dilindungi.</p>
                <div class="flex items-center gap-4 text-stone-500">
                    <span>Bayar di Tempat (COD)</span>
                    <span>•</span>
                    <span>Buku Original Penerbit</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
