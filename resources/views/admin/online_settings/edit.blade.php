@extends('layouts.admin')

@section('content')
<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-xl font-black text-[#006064] uppercase tracking-tighter">Dashboard Utama</h1>
        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">BimbelinAja Management System</p>
    </div>
    <a href="{{ route('admin.online-settings.index') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#006064] transition-colors">← Kembali ke Daftar</a>
</div>

<div class="mb-10">
    <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">Edit Konten Laman</h2>
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Bagian: {{ strtoupper(str_replace('_', ' ', $setting->section)) }}</p>
</div>

<form action="{{ route('admin.online-settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-12 rounded-[3rem] shadow-2xl shadow-teal-900/5 relative overflow-hidden">
    @csrf
    @method('PATCH')

    {{-- Aksentuasi Kuning di pojok --}}
    <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFC107]/5 rounded-bl-full"></div>

    <div class="space-y-12 relative z-10">
        {{-- INPUT JUDUL --}}
        <div>
            <label class="text-[9px] font-black text-teal-600 uppercase tracking-[0.2em] mb-4 block italic">Judul Utama Seksi</label>
            <input type="text" name="title" value="{{ old('title', $setting->title) }}" 
                   class="w-full bg-gray-50/50 border-none rounded-[2rem] p-6 text-sm font-bold text-[#006064] focus:ring-2 focus:ring-[#FFC107] shadow-inner outline-none">
        </div>

        {{-- INPUT DESKRIPSI --}}
        <div>
            <label class="text-[9px] font-black text-teal-600 uppercase tracking-[0.2em] mb-4 block italic">Teks Penjelasan / Deskripsi</label>
            <textarea name="description" rows="6" 
                      class="w-full bg-gray-50/50 border-none rounded-[2rem] p-8 text-sm font-medium text-gray-600 leading-relaxed focus:ring-2 focus:ring-[#FFC107] shadow-inner outline-none">{{ old('description', $setting->description) }}</textarea>
        </div>

        {{-- MEDIA / PREVIEW IMAGE --}}
        <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-12 p-8 bg-gray-50/30 rounded-[2.5rem] border border-gray-50">
            <div class="relative group">
                <div class="w-32 h-32 bg-white rounded-[2rem] flex items-center justify-center border-4 border-white shadow-xl overflow-hidden">
                    {{-- PERBAIKAN: Jalur asset langsung ke public/uploads/online_page --}}
                    @if($setting->image && file_exists(public_path($setting->image)))
                        <img src="{{ asset($setting->image) }}" class="w-full h-full object-cover transition-transform group-hover:scale-110 duration-500">
                    @endif
                </div>
            </div>

            <div class="flex-1 w-full text-center md:text-left">
                <label class="text-[9px] font-black text-teal-600 uppercase tracking-[0.2em] mb-4 block italic">Ganti Visual / Ikon</label>
                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg, image/svg+xml"
                       class="text-[10px] text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-900 transition-all cursor-pointer">
                
                {{-- PENJELASAN FORMAT (Hitam & Merah) --}}
                <div class="mt-4 space-y-1">
                    <p class="text-[9px] text-black font-black uppercase tracking-widest italic">
                        * Format: JPG, PNG, JPEG, SVG (Maks 2MB)
                    </p>
                    <p class="text-[9px] text-red-600 font-black uppercase tracking-widest italic">
                        🚫 Dilarang Upload PDF, Video, Atau File Dokumen Lainnya
                    </p>
                </div>
            </div>
        </div>

        {{-- TOMBOL SIMPAN --}}
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-[#FFC107] text-[#006064] font-black py-5 px-16 rounded-2xl shadow-xl shadow-yellow-500/40 hover:bg-yellow-500 hover:-translate-y-1 transition-all uppercase tracking-[0.2em] text-[10px] italic">
                Simpan Perubahan Konten 
            </button>
        </div>
    </div>
</form>
@endsections