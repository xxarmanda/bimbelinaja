@extends('layouts.admin')
@section('content')
<div class="max-w-5xl mx-auto pb-20">
    <div class="mb-10">
        <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic">Narasi & Profil Website</h2>
        <p class="text-gray-500 mt-2 font-medium italic">Kelola teks tentang kami dan video profil BimbelinAja di sini.</p>
    </div>

    <form action="{{ route('admin.settings.video.update') }}" method="POST" class="space-y-10">
        @csrf @method('PATCH')
        
        {{-- SEKSI 2: TENTANG KAMI & VIDEO --}}
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 space-y-8">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-[#006064] p-2 rounded-lg text-white font-black text-[10px]">ABOUT</div>
                <h3 class="font-black text-[#006064] uppercase tracking-tighter">Narasi Profil & Video</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Label Atas (Contoh: SIAPA KAMI?)</label>
                    <input type="text" name="about_label" value="{{ $settings['about_label'] ?? '' }}" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064]">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Judul Profil Utama</label>
                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? '' }}" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064]">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Paragraf Deskripsi 1</label>
                    <textarea name="about_desc_1" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064] h-32">{{ $settings['about_desc_1'] ?? '' }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Paragraf Deskripsi 2</label>
                    <textarea name="about_desc_2" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064] h-32">{{ $settings['about_desc_2'] ?? '' }}</textarea>
                </div>
            </div>

            <hr class="border-gray-50">

            <div class="space-y-4">
            <label class="block text-[10px] font-black uppercase text-black ml-2 italic">Link Video YouTube (Company Profile)</label>
            
            <input type="text" name="youtube_url" value="{{ $settings['youtube_video_id'] ?? '' }}" 
                placeholder="https://www.youtube.com/watch?v=..." 
                class="w-full p-5 rounded-2xl border-2 border-gray-100 bg-[#F8FAFC] focus:border-black outline-none font-bold text-black transition-all">
            
            {{-- INFO FORMAT: Teks Hitam & Peringatan Merah --}}
            <div class="mt-3 ml-2">
                <p class="text-[9px] text-black font-black uppercase tracking-widest italic">
                    * Contoh Format: https://www.youtube.com/watch?v=dQw4w9WgXcQ
                </p>
                <p class="text-[9px] text-red-600 font-black uppercase tracking-widest italic mt-1">
                    🚫 Gunakan Link YouTube Asli (Bukan Short Link / Link Video Lain)
                </p>
            </div>
        </div>

            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" class="bg-[#006064] text-white font-black py-4 px-10 rounded-2xl shadow-xl hover:bg-teal-900 transition uppercase tracking-widest text-xs">
                    Simpan Perubahan Narasi 
                </button>
            </div>
        </div>
    </form>

    {{-- AREA HAPUS VIDEO (DANGER ZONE) --}}
@if(isset($settings['youtube_video_id']))
    <div class="mt-12 pt-8 border-t border-red-50 flex flex-col md:flex-row items-center justify-between bg-red-50/50 p-8 rounded-[2.5rem] gap-6">
        <div class="flex items-center space-x-5">
            {{-- Ikon Tong Sampah Mewah --}}
            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-red-500 shadow-sm border border-red-100 shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <div class="text-center md:text-left">
                <p class="text-[11px] font-black text-red-500 uppercase italic tracking-[0.2em] leading-none mb-1">Peringatan Penghapusan</p>
                <p class="text-[10px] text-gray-400 font-bold uppercase italic leading-tight">Video YouTube yang aktif akan dihapus  <br class="hidden md:block"> dari database dan halaman utama.</p>
            </div>
        </div>

        <form action="{{ route('admin.settings.video.destroy') }}" method="POST" onsubmit="return confirm('HATI-HATI: Anda akan menghapus video ini dari sistem. Lanjutkan?')" class="w-full md:w-auto">
            @csrf 
            @method('DELETE')
            <button type="submit" class="w-full md:w-auto bg-white hover:bg-red-500 hover:text-white text-red-500 border border-red-100 font-black px-10 py-4 rounded-2xl uppercase tracking-[0.2em] text-[10px] italic transition-all active:scale-95 shadow-sm hover:shadow-xl hover:shadow-red-500/20">
                Hapus Video 
            </button>
        </form>
    </div>
@endif
</div>
@endsection