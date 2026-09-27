@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 py-10 sm:py-14">
    <div class="bg-white rounded-3xl border border-stone-200 shadow-2xs p-6 sm:p-10">
        
        <div class="mb-6">
            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2.5 py-0.5 rounded-full border border-emerald-200">
                Pusat Bantuan Pelanggan
            </span>
            <h1 class="font-book-title text-2xl sm:text-3xl font-bold text-stone-900 mt-2">Hubungi Layanan Admin</h1>
            <p class="text-xs text-stone-500 mt-1">Sampaikan pesan, masukan, pertanyaan ketersediaan judul, atau kendala pemesanan COD Anda.</p>
        </div>

        <!-- Quick Contacts Banner -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
            <div class="p-3.5 bg-stone-50 rounded-2xl border border-stone-200 text-xs">
                <div class="font-bold text-stone-800">Layanan WhatsApp CS</div>
                <div class="text-[11px] text-emerald-800 font-semibold mt-0.5">+62 812-3456-7890</div>
                <div class="text-[10px] text-stone-400 mt-0.5">Senin - Minggu: 08:00 - 21:00 WIB</div>
            </div>
            <div class="p-3.5 bg-stone-50 rounded-2xl border border-stone-200 text-xs">
                <div class="font-bold text-stone-800">Alamat Surat Elektronik</div>
                <div class="text-[11px] text-emerald-800 font-semibold mt-0.5">bantuan@aksarapustaka.com</div>
                <div class="text-[10px] text-stone-400 mt-0.5">Balasan estimasi 1x24 jam kerja</div>
            </div>
        </div>

        <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Pengirim Pesan</label>
                <input 
                    type="text" 
                    class="w-full px-3 py-2 bg-stone-100 border border-stone-200 rounded-xl text-xs font-semibold text-stone-700" 
                    value="{{ auth()->user()->name }} ({{ auth()->user()->email }})" 
                    readonly 
                />
            </div>

            <div>
                <label for="subject" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Topik / Subjek Pesan</label>
                <input 
                    type="text" 
                    id="subject" 
                    name="subject" 
                    value="{{ old('subject') }}" 
                    class="w-full px-3 py-2 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('subject') border-rose-500 @enderror" 
                    placeholder="Contoh: Pertanyaan Ketersediaan Judul Buku / Jadwal COD" 
                    required 
                />
                @error('subject')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block text-[11px] font-bold uppercase tracking-wider text-stone-600 mb-1.5">Uraian Pesan</label>
                <textarea 
                    id="body" 
                    name="body" 
                    rows="5" 
                    class="w-full px-3 py-2.5 bg-stone-50 border border-stone-200 rounded-xl text-xs font-medium outline-none focus:bg-white focus:border-emerald-700 @error('body') border-rose-500 @enderror" 
                    placeholder="Tuliskan pertanyaan atau kendala Anda secara lengkap di sini..." 
                    required>{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-[11px] text-rose-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-emerald-800 hover:bg-emerald-900 text-white font-bold text-xs shadow-2xs transition-colors">
                Kirimkan Pesan ke Admin &rarr;
            </button>
        </form>

    </div>
</div>
@endsection
