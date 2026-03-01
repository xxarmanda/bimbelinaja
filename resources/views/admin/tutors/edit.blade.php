@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4">
    
    {{-- HEADER --}}
    <div class="mb-12">
        <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-3 italic">Editor System</h4>
        <h2 class="text-4xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
            Edit Profil <span class="text-teal-500/50">Tutor</span>
        </h2>
        <p class="text-gray-400 mt-4 font-bold italic text-xs uppercase tracking-widest flex items-center">
            <span class="w-8 h-[2px] bg-[#FFC107] mr-3"></span> Memperbarui Data: {{ $tutor->name }}
        </p>
    </div>

    <div class="bg-white rounded-[4rem] p-10 md:p-16 shadow-2xl shadow-teal-900/5 border border-gray-50 relative overflow-hidden">
        {{-- Dekorasi Latar --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/30 rounded-bl-full -z-0 opacity-50"></div>

        <form action="{{ route('admin.tutors.update', $tutor->id) }}" method="POST" enctype="multipart/form-data" class="space-y-12 relative z-10">
            @csrf
            @method('PATCH')

            <div class="grid md:grid-cols-2 gap-12">
                <div class="space-y-8">
                    {{-- Nama Tutor --}}
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Nama Lengkap Tutor</label>
                        <input type="text" name="name" value="{{ old('name', $tutor->name) }}" required
                               class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    </div>

                    {{-- Role/Keahlian --}}
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Bidang Keahlian / Role</label>
                        <input type="text" name="role" value="{{ old('role', $tutor->role) }}" required
                               placeholder="Contoh: Tutor Matematika (SMA)"
                               class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    </div>
                </div>

                {{-- FOTO TUTOR --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Foto Profil Aktif</label>
                    <div class="flex flex-col items-center gap-6">
                        
                        {{-- Preview Foto Sekarang --}}
                        <div class="relative group">
                            <div class="absolute -inset-2 bg-teal-50 rounded-full blur opacity-50"></div>
                            <div class="relative w-40 h-40 bg-white rounded-full flex items-center justify-center p-2 border-4 border-white shadow-xl overflow-hidden">
                                @if($tutor->photo && file_exists(public_path($tutor->photo)))
                                    {{-- PERBAIKAN: Path langsung tanpa 'storage/' --}}
                                    <img src="{{ asset($tutor->photo) }}" class="w-full h-full object-cover rounded-full transition-transform group-hover:scale-110 duration-500">
                                @else
                                    <div class="w-full h-full bg-gray-50 flex items-center justify-center rounded-full text-4xl">👨‍🏫</div>
                                @endif
                            </div>
                        </div>

                        {{-- Input Upload Foto Baru dengan Peringatan Format --}}
                        <div class="w-full">
                            <label for="photo" class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-teal-100 rounded-[2rem] cursor-pointer bg-teal-50/20 hover:bg-teal-50 transition-all group">
                                <div class="flex flex-col items-center justify-center">
                                    <p class="text-[9px] font-black text-gray-400 group-hover:text-[#006064] uppercase italic tracking-widest transition-colors">Ganti Foto Profil</p>
                                </div>
                                {{-- PERBAIKAN: Atribut accept untuk memblokir PDF/Doc --}}
                                <input id="photo" type="file" name="photo" class="hidden" accept="image/png, image/jpeg, image/jpg" />
                            </label>

                            {{-- INFO FORMAT PREMIUM --}}
                            <div class="mt-4 flex flex-col items-center space-y-1">
                                <p class="text-[8px] font-black text-[#006064] uppercase tracking-widest opacity-60 italic text-center">
                                    Format Wajib: <span class="text-[#FFC107]">PNG, JPG, JPEG</span> (Maks 2MB)
                                </p>
                                <p class="text-[8px] font-black text-red-500 uppercase tracking-widest italic text-center">
                                    !!Dilarang Upload PDF / Dokumen Lainnya!!
                                </p>
                            </div>

                            @error('photo')
                                <p class="text-red-500 text-[9px] font-black italic mt-2 uppercase text-center">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="pt-12 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                <a href="{{ route('admin.tutors.index') }}" 
                   class="w-full md:w-auto flex items-center justify-center gap-3 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-10 py-6 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] italic transition-all shadow-sm group">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>Batal & Kembali</span>
                </a>
                
                <button type="submit" 
                        class="w-full md:w-auto bg-[#006064] hover:bg-teal-900 text-white font-black px-16 py-6 rounded-[2rem] shadow-2xl shadow-teal-900/30 uppercase tracking-[0.3em] text-[10px] italic transition-all active:scale-95 flex items-center justify-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Simpan Perubahan 
                </button>
            </div>
        </form>
    </div>
</div>
@endsection