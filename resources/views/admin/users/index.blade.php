@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold">Daftar Pelanggan (Users)</h1>
        <p class="text-sm text-base-content/70">Data akun pelanggan terdaftar di WahyuStore</p>
    </div>

    <div class="card bg-base-100 shadow-sm border border-base-300">
        <div class="p-4 border-b border-base-200">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex gap-2 max-w-sm">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email / HP..." class="input input-sm input-bordered w-full" />
                <button type="submit" class="btn btn-sm btn-primary">Cari</button>
                @if(request('search'))
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-ghost">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="bg-base-200 text-xs">
                        <th>Pelanggan</th>
                        <th>No. Handphone</th>
                        <th>Total Pesanan</th>
                        <th>Terdaftar Sejak</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <div class="font-bold text-sm">{{ $user->name }}</div>
                                <div class="text-xs text-base-content/60">{{ $user->email }}</div>
                            </td>
                            <td class="text-xs">{{ $user->phone ?? '-' }}</td>
                            <td>
                                <span class="badge badge-sm badge-ghost font-semibold">{{ $user->orders_count }} pesanan</span>
                            </td>
                            <td class="text-xs text-base-content/70">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-right">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-xs btn-outline">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-8 text-base-content/60">Tidak ada pelanggan ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-base-200 flex justify-center">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
