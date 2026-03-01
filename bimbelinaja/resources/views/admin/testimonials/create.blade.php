@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto pb-20" x-data="{ photoPreview: null }">
    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">Tambah Testimoni Baru</h2>
            <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mt-1">Input data tutor untuk seksi "Kata Mereka"</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-500 px-6 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest transition-all">
            ⬅️ Kembali
        </a>
    </div>

    {{-- Form Utama --}}
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            {{-- SISI KIRI: Upload Foto --}}
            <div class="lg:col-span-1">
                <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 text-center">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-6 italic">Foto Profil Tutor</label>
                    
                    <div class="relative inline-block">
                        {{-- Lingkaran Preview --}}
                        <div class="w-40 h-40 rounded-full border-4 border-teal-50 overflow-hidden bg-gray-50 mx-auto mb-6 shadow-inner flex items-center justify-center">
                            <template x-if="!photoPreview">
                                <svg class="w-16 h-16 text-gray-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
                        </div>
                        
                        {{-- Custom File Input --}}
                        <label class="absolute bottom-2 right-2 bg-[#FFC107] p-3 rounded-2xl shadow-lg cursor-pointer hover:scale-110 transition-transform border-4 border-white">
                            <svg class="w-5 h-5 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <input type="file" name="photo" class="hidden" accept="image/*" 
                                   @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result }; reader.readAsDataURL(file); }">
                        </label>
                    </div>
                    <p class="text-[9px] text-gray-400 italic">Klik ikon kamera untuk pilih foto</p>
                </div>
            </div>

            {{-- SISI KANAN: Data Teks --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-2 ml-2">Nama Lengkap Tutor</label>
                            <input type="text" name="name" required placeholder="Contoh: Rizky Pratama" 
                                   class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-2 ml-2">Peran / Bidang</label>
                            <input type="text" name="role" required placeholder="Contoh: Coach Matematika" 
                                   class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-2 ml-2">Durasi Bergabung</label>
                        <input type="text" name="duration" required placeholder="Contoh: 2 Tahun / 1.5 Tahun" 
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-2 ml-2">Kutipan Testimoni</label>
                        <textarea name="quote" required placeholder="Tuliskan pengalaman tutor mengajar di sini..." 
                                  class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all h-32"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-[#006064] hover:bg-teal-900 text-white font-black py-5 rounded-2xl shadow-xl transition-all transform active:scale-95 uppercase tracking-[0.2em] italic text-xs flex items-center justify-center gap-3">
                            <svg class="w-5 h-5 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Testimoni ✨
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>
@endsection