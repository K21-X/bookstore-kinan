<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Panel Admin - Alinea Bookstore' }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS v4 & DaisyUI via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #f7f6f2;
            color: #292524;
        }
        .font-serif-title {
            font-family: 'Lora', Georgia, serif;
        }
    </style>
</head>
<body class="min-h-screen antialiased flex flex-col selection:bg-stone-800 selection:text-white">

    <div class="drawer lg:drawer-open flex-1">
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Area Konten Utama Admin -->
        <div class="drawer-content flex flex-col min-h-screen">
            
            <!-- Topbar Navigasi Admin -->
            <header class="bg-white border-b border-stone-200 px-4 sm:px-6 py-3 sticky top-0 z-30 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <label for="admin-drawer" class="btn btn-ghost btn-sm btn-square text-stone-600 lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                    <div class="flex items-center gap-2 text-xs text-stone-500 font-medium">
                        <span class="text-stone-900 font-semibold">Panel Admin</span>
                        <span>/</span>
                        <span>Kelola Toko</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200/80 text-stone-700 text-xs font-medium transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Toko Publik</span>
                    </a>

                    <div class="dropdown dropdown-end">
                        <button tabindex="0" class="flex items-center gap-2 p-1 pl-2 pr-2.5 rounded-lg border border-stone-200 text-stone-800 hover:bg-stone-100 transition-colors text-xs font-medium cursor-pointer">
                            <span class="w-6 h-6 rounded-full bg-stone-800 text-white font-semibold text-[11px] flex items-center justify-center uppercase">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </span>
                            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <ul tabindex="0" class="dropdown-content menu bg-white border border-stone-200 rounded-xl z-50 w-44 p-2 shadow-lg mt-2 text-xs">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-rose-600 hover:bg-rose-50 rounded-lg py-1.5 font-medium">
                                        Keluar Akun
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Container Konten -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="p-3.5 rounded-lg bg-stone-100 border border-stone-300 text-stone-800 mb-6 flex items-center gap-2.5 text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-stone-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-3.5 rounded-lg bg-rose-50 border border-rose-200 text-rose-800 mb-6 flex items-center gap-2.5 text-xs font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Sidebar Bersih & Minimalis -->
        <div class="drawer-side z-40">
            <label for="admin-drawer" aria-label="Tutup navigasi" class="drawer-overlay"></label>
            <aside class="bg-white text-stone-700 w-60 min-h-full border-r border-stone-200 p-4 flex flex-col justify-between">
                <div>
                    <!-- Header Brand Sidebar -->
                    <div class="px-2 py-3 mb-4 border-b border-stone-100 flex items-baseline gap-2">
                        <span class="font-serif-title text-xl font-bold tracking-tight text-stone-900">Alinea</span>
                        <span class="text-[10px] uppercase font-semibold text-stone-400">Admin</span>
                    </div>

                    <!-- Menu Navigasi -->
                    <div class="px-2 mb-2 text-[10px] font-bold uppercase tracking-wider text-stone-400">
                        Menu Utama
                    </div>
                    <ul class="space-y-1 text-xs font-medium">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-stone-900 text-white font-semibold' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-stone-900 text-white font-semibold' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span>Kategori Buku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.books.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.books.*') ? 'bg-stone-900 text-white font-semibold' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Daftar Buku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-stone-900 text-white font-semibold' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <span>Pesanan Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-stone-900 text-white font-semibold' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>Data Pelanggan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kartu User Bagian Bawah -->
                <div class="pt-3 border-t border-stone-100">
                    <div class="p-2.5 bg-stone-50 rounded-lg border border-stone-200 mb-2 flex items-center gap-2">
                        <div class="w-7 h-7 rounded-full bg-stone-800 text-white font-semibold text-xs flex items-center justify-center uppercase shrink-0">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden text-xs">
                            <div class="font-semibold text-stone-900 truncate">{{ auth()->user()->name }}</div>
                            <div class="text-[10px] text-stone-400 truncate">{{ auth()->user()->email }}</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center text-rose-600 hover:bg-rose-50 text-xs font-medium py-1.5 rounded-lg transition-colors">
                            Keluar dari Panel
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

</body>
</html>
