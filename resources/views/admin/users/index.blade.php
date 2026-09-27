@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-white p-5 rounded-2xl border border-stone-200 shadow-2xs">
        <div>
            <h1 class="font-book-title text-2xl font-bold text-stone-900 tracking-tight">Data Pelanggan (Users)</h1>
            <p class="text-xs text-stone-500 mt-0.5">Daftar akun pelanggan terdaftar yang telah bertransaksi di Aksara Pustaka</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-stone-200 shadow-2xs overflow-hidden">
        <!-- Search Filter -->
        <div class="p-4 border-b border-stone-200 bg-stone-50/50">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 max-w-sm">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Cari nama / email / HP..." 
                    class="w-full px-3 py-1.5 bg-white border border-stone-300 rounded-xl text-xs outline-none focus:border-emerald-700" 
                />
                <button type="submit" class="px-3.5 py-1.5 bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs rounded-xl transition-colors">
                    Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-600 rounded-xl text-xs font-semibold transition-colors">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="table w-full">
                <thead>
                    <tr class="bg-stone-50 border-b border-stone-200 text-xs text-stone-500 uppercase font-bold tracking-wider">
                        <th class="py-3 px-6">Pelanggan</th>
                        <th class="py-3 px-4">No. Handphone</th>
                        <th class="py-3 px-4">Histori Transaksi</th>
                        <th class="py-3 px-4">Bergabung Sejak</th>
                        <th class="py-3 px-6 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-stone-50/60 transition-colors">
                            <td class="py-3.5 px-6">
                                <div class="font-bold text-xs sm:text-sm text-stone-900">{{ $user->name }}</div>
                                <div class="text-[10px] text-stone-400 mt-0.5">{{ $user->email }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-stone-600">{{ $user->phone ?? '-' }}</td>
                            <td class="py-3.5 px-4">
                                <span class="badge badge-sm bg-stone-100 text-stone-700 border-stone-200 font-semibold">{{ $user->orders_count }} pesanan</span>
                            </td>
                            <td class="py-3.5 px-4 text-xs text-stone-500 whitespace-nowrap">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="py-3.5 px-6 text-right">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg border border-stone-200">
                                    Lihat Profil
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-xs text-stone-400">Tidak ada data pelanggan yang sesuai ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-stone-200 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
