@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 py-10 sm:py-14">
    <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8">
        
        <div class="mb-6 pb-3 border-b border-stone-100">
            <span class="text-[11px] font-semibold uppercase tracking-wider text-stone-400 block mb-1">
                Bantuan & Layanan
            </span>
            <h1 class="font-serif-title text-2xl font-bold text-stone-900">Hubungi Kami</h1>
            <p class="text-xs text-stone-500 mt-1">Sampaikan pertanyaan seputar ketersediaan judul buku, pengiriman COD, atau kritik dan saran Anda.</p>
        </div>

        <!-- Info Kontak Singkat -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
            <div class="p-3 bg-stone-50 rounded-lg border border-stone-200 text-xs">
                <div class="font-semibold text-stone-800">WhatsApp Layanan</div>
                <div class="text-stone-600 mt-0.5">+62 812-3456-7890</div>
                <div class="text-[10px] text-stone-400 mt-0.5">Senin - Minggu: 08.00 - 21.00 WIB</div>
            </div>
            <div class="p-3 bg-stone-50 rounded-lg border border-stone-200 text-xs">
                <div class="font-semibold text-stone-800">Email</div>
                <div class="text-stone-600 mt-0.5">kontak@alinea.id</div>
                <div class="text-[10px] text-stone-400 mt-0.5">Respon dalam 1x24 jam</div>
            </div>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-[11px] font-semibold text-stone-600 mb-1">Pengirim Pesan</label>
                <input 
                    type="text" 
                    class="w-full px-3 py-2 bg-stone-100 border border-stone-200 rounded-lg text-xs font-medium text-stone-600" 
                    value="{{ auth()->user()->name }} ({{ auth()->user()->email }})" 
                    readonly 
                />
            </div>

            <div>
                <label for="subject" class="block text-[11px] font-semibold text-stone-600 mb-1">Subjek / Topik</label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('subject') border-rose-500 @enderror" 
                    placeholder="Contoh: Pertanyaan Ketersediaan Judul Buku" 
                    required 
                />
                @error('subject')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-[11px] font-semibold text-stone-600 mb-1">Isi Pesan</label>
                <textarea 
                    id="body" 
                    name="body" 
                    rows="4" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-lg text-xs font-medium outline-none focus:bg-white focus:border-stone-400 @error('body') border-rose-500 @enderror" 
                    placeholder="Tuliskan pertanyaan atau kebutuhan Anda..." 
                    required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-2.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-xs transition-colors">
                Kirimkan Pesan
            </button>
        </form>

    </div>
</div>
@endsection
