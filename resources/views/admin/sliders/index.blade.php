@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-10">
    
    {{-- HEADER HALAMAN --}}
    <div class="mb-10">
        <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
            Kelola <span class="text-[#FFC107]">Hero & Slider</span>
        </h2>
        <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em] mt-2">Update Visual & Teks Beranda BimbelinAja</p>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="bg-teal-50 border-l-4 border-teal-500 p-4 mb-10 rounded-2xl text-teal-800 text-xs font-black uppercase tracking-widest">
            {{ session('success') }} 
        </div>
    @endif

    {{-- --- BAGIAN PINDAHAN: PENGATURAN TEKS HERO --- --}}
    <form action="{{ route('admin.settings.video.update') }}" method="POST" class="mb-20">
        @csrf @method('PATCH')
        
        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 space-y-8">
            <div class="flex items-center space-x-3 mb-4">
                <div class="bg-[#FFC107] p-2 rounded-lg text-[#006064] font-black text-[10px]">HERO</div>
                <h3 class="font-black text-[#006064] uppercase tracking-tighter">Teks Utama Beranda</h3>
            </div>
            
            <div class="grid grid-cols-1 gap-8">
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Label Kecil (Misal: LES PRIVAT TERBAIK)</label>
                    <input type="text" name="hero_label" value="{{ $settings['hero_label'] ?? '' }}" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064]">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Judul</label>
                    <textarea name="hero_title" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064] h-24">{{ $settings['hero_title'] ?? '' }}</textarea>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase text-gray-400 ml-2 mb-2">Deskripsi Singkat Hero</label>
                    <textarea name="hero_desc" class="w-full p-4 rounded-2xl border-2 border-gray-50 bg-gray-50 focus:border-[#006064] outline-none font-bold text-[#006064] h-32">{{ $settings['hero_desc'] ?? '' }}</textarea>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-[#006064] text-white font-black py-4 px-10 rounded-2xl shadow-xl hover:bg-teal-900 transition uppercase tracking-widest text-xs">
                    Simpan Perubahan Teks 
                </button>
            </div>
        </div>
    </form>

    {{-- MANAJEMEN GAMBAR SLIDER --}}
    <h3 class="font-black text-[#006064] uppercase tracking-widest text-xs mb-8 flex items-center italic">
        <span class="w-6 h-1 bg-[#FFC107] mr-3 rounded-full"></span> Pengaturan Gambar Slider
    </h3>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        {{-- FORM TAMBAH SLIDER --}}
        <div class="lg:col-span-1">
    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-[#006064]/5 border border-gray-50">
        <h3 class="text-[#006064] font-black uppercase tracking-widest text-[10px] mb-6">Tambah Slide Baru</h3>
        
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-[10px] font-black uppercase text-black ml-2 mb-2 italic">Pilih Gambar Slider</label>
                
                <input type="file" name="image" required accept="image/png, image/jpeg, image/jpg"
                       class="w-full p-4 rounded-2xl border-2 border-dashed border-gray-100 bg-[#F8FAFC] font-bold text-black text-xs cursor-pointer">
                
                <div class="mt-3 px-2">
                    {{-- Info Format tetap Hitam --}}
                    <p class="text-[8px] font-black text-black uppercase tracking-widest italic">
                        Format Image: PNG, JPG, JPEG (Maks 2MB)
                    </p>
                    {{-- PERBAIKAN: Khusus teks Dilarang menjadi MERAH --}}
                    <p class="text-[8px] font-black text-red-600 uppercase tracking-widest italic mt-1">
                         🚫Dilarang Upload PDF Atau File Dokumen Lainnya
                    </p>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-black ml-2 mb-2 italic">Judul Slide (Opsional)</label>
                <input type="text" name="title" placeholder="Misal: Promo Akhir Tahun" 
                       class="w-full p-4 rounded-2xl border-2 border-gray-100 bg-[#F8FAFC] font-bold text-black text-sm outline-none">
            </div>

            <button type="submit" class="w-full bg-[#006064] hover:bg-black text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-[10px] transition-all active:scale-95">
                Upload Gambar Slider 
            </button>
        </form>
    </div>
</div>

        {{-- DAFTAR SLIDER AKTIF --}}
        <div class="lg:col-span-2">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-[#006064]/5 border border-gray-50">
                @if($sliders->isEmpty())
                    <p class="text-center text-gray-400 italic font-bold py-10 uppercase text-[10px]">Belum ada gambar slider</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($sliders as $slider)
                        <div class="group relative bg-[#F8FAFC] rounded-3xl overflow-hidden border border-gray-100 hover:border-[#006064]/20 transition-all">
                            <div class="aspect-video w-full overflow-hidden bg-gray-200">
                                <img src="{{ asset($slider->image) }}" class="w-full h-full object-cover">
                            </div>
                            <div class="p-5 flex justify-between items-center bg-white">
                                <div>
                                    <p class="text-[10px] font-black text-[#006064] uppercase tracking-wider">{{ $slider->title ?? 'Tanpa Judul' }}</p>
                                </div>
                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection