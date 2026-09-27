<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Panel - Aksara Pustaka' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Lora:wght@600;700&display=swap" rel="stylesheet">
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
<body class="min-h-screen bg-stone-100/70 text-stone-800 antialiased flex flex-col">

    <div class="drawer lg:drawer-open flex-1">
        <input id="admin-drawer" type="checkbox" class="drawer-toggle" />
        
        <!-- Main Admin Content Area -->
        <div class="drawer-content flex flex-col min-h-screen">
            
            <!-- Admin Top Navigation Bar -->
            <header class="bg-white border-b border-stone-200 px-4 sm:px-6 py-3 sticky top-0 z-30 shadow-2xs flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <label for="admin-drawer" class="btn btn-ghost btn-sm btn-square text-stone-600 lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </label>
                    <div class="flex items-center gap-2 text-xs font-semibold text-stone-500">
                        <span class="text-emerald-800 font-bold">Admin Workspace</span>
                        <span>/</span>
                        <span class="text-stone-800">Manajemen Toko</span>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-stone-100 hover:bg-stone-200/80 text-stone-700 text-xs font-semibold border border-stone-200 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-emerald-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        <span>Lihat Toko Publik</span>
                    </a>

                    <div class="dropdown dropdown-end">
                        <div tabindex="0" role="button" class="flex items-center gap-2 p-1 pl-2 pr-3 bg-stone-100 hover:bg-stone-200/80 rounded-full border border-stone-200 cursor-pointer transition-colors">
                            <div class="w-6 h-6 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center uppercase">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </div>
                            <span class="text-xs font-bold text-stone-700 hidden sm:inline">{{ auth()->user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-stone-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                        <ul tabindex="0" class="dropdown-content menu bg-white border border-stone-200 rounded-2xl z-50 w-48 p-2 shadow-xl mt-2 text-xs">
                            <li class="menu-title text-[10px] uppercase font-bold text-stone-400">Akun Masuk</li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full text-left text-rose-600 font-semibold py-1.5 hover:bg-rose-50 rounded-lg">
                                        Keluar Akun
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- Main Content Container -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 mb-6 flex items-center gap-3 shadow-2xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-700 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs sm:text-sm font-semibold">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 mb-6 flex items-center gap-3 shadow-2xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-rose-600 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-xs sm:text-sm font-semibold">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>

        <!-- Clean Light Admin Sidebar -->
        <div class="drawer-side z-40">
            <label for="admin-drawer" aria-label="Tutup navigasi" class="drawer-overlay"></label>
            <aside class="bg-white text-stone-700 w-64 min-h-full border-r border-stone-200 p-4 flex flex-col justify-between">
                <div>
                    <!-- Sidebar Brand Header -->
                    <div class="px-2 py-3 mb-4 border-b border-stone-100 flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-emerald-800 text-white flex items-center justify-center shadow-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <div>
                            <span class="font-book-title text-base font-extrabold text-stone-900 block leading-tight">Aksara Pustaka</span>
                            <span class="inline-block px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-800 text-[10px] font-bold uppercase tracking-wider border border-emerald-200">
                                Panel Admin
                            </span>
                        </div>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="px-2 mb-2 text-[10px] font-bold uppercase tracking-wider text-stone-400">
                        Menu Utama
                    </div>
                    <ul class="space-y-1 text-xs font-semibold">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-800 text-white font-bold shadow-xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-800 text-white font-bold shadow-xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span>Kategori Buku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.books.*') ? 'bg-emerald-800 text-white font-bold shadow-xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <span>Daftar Buku</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-800 text-white font-bold shadow-xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                    <span>Pesanan Masuk</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-emerald-800 text-white font-bold shadow-xs' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span>Data Pelanggan</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Bottom User Card -->
                <div class="pt-4 border-t border-stone-100">
                    <div class="p-3 bg-stone-50 rounded-xl border border-stone-200/80 mb-2">
                        <div class="flex items-center gap-2.5">
                            <div class="w-8 h-8 rounded-full bg-emerald-800 text-white font-bold text-xs flex items-center justify-center uppercase">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </div>
                            <div class="overflow-hidden">
                                <div class="text-xs font-bold text-stone-900 truncate">{{ auth()->user()->name }}</div>
                                <div class="text-[10px] text-stone-500 truncate">{{ auth()->user()->email }}</div>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-center text-rose-600 hover:text-rose-700 hover:bg-rose-50 text-xs font-semibold py-1.5 rounded-lg transition-colors">
                            Keluar dari Panel
                        </button>
                    </form>
                </div>
            </aside>
        </div>
    </div>

</body>
</html>
