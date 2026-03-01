@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto pb-20">
    {{-- Breadcrumb & Header --}}
    <div class="mb-10">
        <a href="{{ route('admin.registration-steps.index') }}" class="text-[#006064] font-black uppercase text-[10px] tracking-widest flex items-center hover:opacity-70 transition-opacity mb-4">
            ⬅ Kembali ke Daftar
        </a>
        <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
            Tambah Langkah Baru
        </h2>
        <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
            Isi detail langkah pendaftaran untuk ditampilkan di halaman utama.
        </p>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-teal-900/5 p-10 md:p-16 border border-gray-100">
        <form action="{{ route('admin.registration-steps.store') }}" method="POST" enctype="multipart/form-data">
            @csrf {{-- Token Keamanan Wajib Laravel --}}

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                {{-- Bagian Kiri: Input Teks --}}
                <div class="space-y-8">
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Judul Langkah</label>
                        <input type="text" name="title" required placeholder="Contoh: 1. Registrasi Online"
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Urutan Tampil</label>
                        <input type="number" name="order" required placeholder="Contoh: 1"
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Deskripsi Singkat</label>
                        <textarea name="description" rows="4" required placeholder="Jelaskan apa yang harus dilakukan siswa pada langkah ini..."
                                  class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none leading-relaxed"></textarea>
                    </div>
                </div>

                {{-- Bagian Kanan: Upload Ikon dengan Preview --}}
                <div class="space-y-8" x-data="{ photoName: null, photoPreview: null }">
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Ikon Langkah (PNG/JPG/SVG)</label>
                        
                        <input type="file" name="icon" class="hidden" x-ref="photo" required
                               @change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                               ">

                        {{-- Kotak Preview --}}
                        <div class="relative group cursor-pointer" @click.prevent="$refs.photo.click()">
                            <div class="w-full h-64 bg-gray-50 rounded-[2.5rem] border-4 border-dashed border-gray-100 flex items-center justify-center overflow-hidden group-hover:bg-teal-50 transition-all">
                                
                                <template x-if="! photoPreview">
                                    <div class="text-center">
                                        <svg class="w-12 h-12 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Klik Untuk Upload</p>
                                    </div>
                                </template>

                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-contain p-8 transform group-hover:scale-110 transition-transform duration-500">
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Tombol Submit --}}
            <div class="mt-16 flex justify-center">
                <button type="submit" 
                        class="bg-[#006064] text-white px-20 py-5 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] hover:bg-teal-900 transition-all shadow-2xl shadow-teal-900/20 active:scale-95">
                    Simpan Langkah Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection