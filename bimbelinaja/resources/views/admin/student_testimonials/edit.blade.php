<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-[3rem] p-12 shadow-xl shadow-teal-900/5 border border-gray-50">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter mb-10">Edit Testimoni Siswa</h2>

            <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nama Siswa --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $testimonial->name }}" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-bold text-[#006064]" required>
                    </div>

                    {{-- Jabatan/Title --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Keterangan (Contoh: Siswa SMK)</label>
                        <input type="text" name="title" value="{{ $testimonial->title }}" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-bold text-[#006064]" required>
                    </div>
                </div>

                {{-- Pesan Testimoni --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Pesan Testimoni</label>
                    <textarea name="message" rows="4" class="w-full bg-gray-50 border-none rounded-[2rem] px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-medium text-gray-600 italic" required>{{ $testimonial->message }}</textarea>
                </div>

                {{-- Upload Foto (MENGGANTIKAN YOUTUBE) --}}
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Foto Profil Siswa</label>
                    <div class="flex items-center space-x-6 bg-teal-50/50 p-8 rounded-[2.5rem] border-2 border-dashed border-teal-100 transition-all hover:bg-teal-50">
                        @if($testimonial->image)
                            <div class="relative group">
                                <img src="{{ asset('storage/' . $testimonial->image) }}" class="w-24 h-24 rounded-2xl object-cover shadow-md border-4 border-white">
                                <div class="absolute inset-0 bg-black/20 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-[8px] text-white font-black uppercase tracking-tighter">Foto Saat Ini</span>
                                </div>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            <input type="file" name="image" class="block w-full text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-700 cursor-pointer">
                            <p class="text-[9px] text-gray-400 italic mt-3 ml-1 uppercase tracking-widest">*Kosongkan jika tidak ingin mengganti foto profil siswa.</p>
                        </div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 rounded-2xl transition-all shadow-lg shadow-yellow-500/20 uppercase tracking-[0.2em] text-xs">
                        Simpan Perubahan Testimoni
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>