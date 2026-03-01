@extends('layouts.admin')

@section('content')
<div class="p-6 pb-20">
    {{-- HEADER HALAMAN --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-12">
        <div>
            <h2 class="text-4xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">Manajemen Tutor</h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-3 flex items-center">
                <span class="w-8 h-[2px] bg-[#FFC107] mr-3"></span> Panel Kendali Tenaga Pengajar
            </p>
        </div>
        <a href="{{ route('admin.tutors.create') }}" class="bg-[#006064] hover:bg-teal-900 text-white px-10 py-5 rounded-[2rem] font-black uppercase text-[10px] tracking-widest transition-all shadow-2xl shadow-teal-900/20 active:scale-95 italic">
            + Tambah Tutor Baru
        </a>
    </div>

    {{-- --- PENGATURAN TEKS SEKSI TUTOR --- --}}
    <form action="{{ route('admin.settings.video.update') }}" method="POST" class="mb-20">
        @csrf @method('PATCH')
        <div class="bg-white p-10 md:p-14 rounded-[4rem] shadow-sm border border-gray-100 relative overflow-hidden group">
            {{-- Dekorasi Latar --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/50 rounded-bl-full opacity-50 -z-0"></div>
            
            <div class="relative z-10 space-y-10">
                <div class="flex items-center space-x-4 mb-4">
                    <div class="bg-[#FFC107] p-3 rounded-2xl text-[#006064] font-black text-xs italic shadow-lg shadow-yellow-500/20">TEXT</div>
                    <h3 class="font-black text-xl text-[#006064] uppercase tracking-tighter italic">Konfigurasi Teks Seksi Tutor</h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-3 italic">Label Atas (Kecil)</label>
                            <input type="text" name="tutor_label" value="{{ $settings['tutor_label'] ?? '' }}" class="w-full bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white rounded-2xl p-5 font-bold text-sm text-[#006064] outline-none transition-all shadow-inner">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-3 italic">Judul Utama (HTML Support)</label>
                            <input type="text" name="tutor_title" value="{{ $settings['tutor_title'] ?? '' }}" class="w-full bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white rounded-2xl p-5 font-bold text-sm text-[#006064] outline-none transition-all shadow-inner">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest ml-3 italic">Deskripsi Seksi Tutor</label>
                        <textarea name="tutor_desc" rows="6" class="w-full bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white rounded-[2.5rem] p-6 font-bold text-sm text-[#006064] outline-none transition-all shadow-inner italic leading-relaxed">{{ $settings['tutor_desc'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-50">
                    <button type="submit" class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] px-12 py-5 rounded-2xl font-black uppercase text-[10px] tracking-widest shadow-2xl shadow-yellow-500/30 transition-all active:scale-95 italic">
                        Update Konten Teks ✨
                    </button>
                </div>
            </div>
        </div>
    </form>

    {{-- DAFTAR TUTOR --}}
    <div class="flex items-center space-x-4 mb-10 ml-2">
        <h3 class="font-black text-2xl text-[#006064] uppercase tracking-tighter italic">Daftar Tutor Aktif</h3>
        <span class="h-[2px] w-20 bg-teal-100 mt-1"></span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
        @forelse($tutors as $tutor)
        <div class="bg-white rounded-[3.5rem] p-10 shadow-sm border border-gray-100 flex flex-col items-center text-center group hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
            
            {{-- Foto Tutor dengan Ring Warna --}}
            <div class="relative w-36 h-36 mb-8">
                <div class="absolute inset-0 bg-gradient-to-tr from-[#FFC107] to-yellow-200 rounded-full translate-x-2 translate-y-2 opacity-0 group-hover:opacity-100 transition-all duration-700 blur-sm"></div>
                <div class="relative w-full h-full rounded-full overflow-hidden border-4 border-white shadow-xl z-10 group-hover:scale-105 transition-transform duration-700">
                    <img src="{{ asset('storage/' . $tutor->photo) }}" class="w-full h-full object-cover transition-all duration-700 grayscale group-hover:grayscale-0">
                </div>
            </div>

            <h4 class="font-black text-[#006064] text-xl uppercase italic tracking-tighter leading-[0.9] mb-3">{{ $tutor->name }}</h4>
            <p class="text-[9px] text-teal-600 font-black uppercase tracking-[0.3em] mb-10 px-4 py-1.5 bg-teal-50 rounded-full italic">{{ $tutor->role }}</p>
            
            {{-- TOMBOL AKSI BERWARNA --}}
            <div class="flex items-center space-x-3 w-full pt-6 border-t border-gray-50">
                {{-- Edit (Teal) --}}
                <a href="{{ route('admin.tutors.edit', $tutor->id) }}" class="flex-1 h-14 flex items-center justify-center bg-teal-50 hover:bg-[#006064] text-[#006064] hover:text-white rounded-2xl transition-all shadow-sm hover:shadow-xl group/btn">
                    <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </a>
                
                {{-- Hapus (Merah) --}}
                <form action="{{ route('admin.tutors.destroy', $tutor->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus tutor ini?')" class="flex-1">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full h-14 flex items-center justify-center bg-red-50 hover:bg-red-500 text-red-400 hover:text-white rounded-2xl transition-all shadow-sm hover:shadow-xl group/btn">
                        <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full py-32 bg-white rounded-[4rem] text-center border-2 border-dashed border-teal-50">
            <div class="bg-teal-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                <span class="text-4xl">👨‍🏫</span>
            </div>
            <p class="text-gray-400 font-black uppercase text-[10px] italic tracking-[0.4em]">Belum Ada Tenaga Pengajar Terdaftar</p>
        </div>
        @endforelse
    </div>
</div>
@endsection