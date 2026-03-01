@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto pb-20">
    {{-- Breadcrumb & Header --}}
    <div class="mb-10">
        <a href="{{ route('admin.registration-steps.index') }}" 
           class="text-[#006064] font-black uppercase text-[10px] tracking-widest flex items-center hover:opacity-70 transition-opacity mb-4">
            ⬅ Kembali
        </a>

        <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
            Edit Langkah Pendaftaran
        </h2>
        <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
            Perbarui detail langkah pendaftaran untuk halaman utama.
        </p>
    </div>

    {{-- Form Section --}}
    <div class="bg-white rounded-[3rem] shadow-2xl shadow-teal-900/5 p-10 md:p-16 border border-gray-100">
        <form action="{{ route('admin.registration-steps.update', $registrationStep->id) }}" 
              method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                
                {{-- Bagian Kiri: Input Teks --}}
                <div class="space-y-8">
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Judul Langkah
                        </label>
                        <input type="text" name="title" value="{{ $registrationStep->title }}" required
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Urutan Tampil
                        </label>
                        <input type="number" name="order" value="{{ $registrationStep->order }}" required
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Deskripsi Singkat
                        </label>
                        <textarea name="description" rows="4" required
                                  class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none leading-relaxed">{{ $registrationStep->description }}</textarea>
                    </div>
                </div>

                {{-- Bagian Kanan: Update Ikon dengan Preview --}}
                <div class="space-y-8" x-data="{ photoPreview: null }">
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Ikon Langkah (PNG/JPG/SVG)
                        </label>
                        
                        <input type="file" name="icon" class="hidden" x-ref="photo"
                               @change="
                                    const reader = new FileReader();
                                    reader.onload = (e) => photoPreview = e.target.result;
                                    reader.readAsDataURL($refs.photo.files[0]);
                               ">

                        {{-- Kotak Preview --}}
                        <div class="relative group cursor-pointer" @click.prevent="$refs.photo.click()">
                            <div class="w-full h-64 bg-gray-50 rounded-[2.5rem] border-4 border-dashed border-gray-100 flex items-center justify-center overflow-hidden group-hover:bg-teal-50 transition-all">
                                
                                {{-- Preview Gambar Baru --}}
                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-contain p-8">
                                </template>

                                {{-- Preview Gambar Lama --}}
                                <template x-if="! photoPreview">
                                    <div class="text-center p-8">
                                        <img src="{{ asset($registrationStep->icon) }}" 
                                             class="w-32 h-32 object-contain mx-auto mb-4 opacity-70">
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                            Klik Untuk Ganti Ikon
                                        </p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Tombol Submit --}}
            <div class="mt-16 flex justify-center">
                <button type="submit" 
                        class="bg-[#006064] text-white px-20 py-5 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] hover:bg-teal-900 transition-all shadow-2xl shadow-teal-900/20">
                    Perbarui Langkah Pendaftaran
                </button>
            </div>
        </form>
    </div>
</div>
@endsection