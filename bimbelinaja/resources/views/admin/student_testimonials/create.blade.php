<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        {{-- Card Container --}}
        <div class="bg-white rounded-[3rem] p-12 shadow-xl shadow-teal-900/5 border border-gray-50 reveal">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter mb-10">Tambah Testimoni Baru</h2>

            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Nama Siswa --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Nama Lengkap Siswa</label>
                        <input type="text" name="name" placeholder="Contoh: Raja Firndawi" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-bold text-[#006064]" required>
                    </div>

                    {{-- Jabatan/Title --}}
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Keterangan (Contoh: Siswa SD)</label>
                        <input type="text" name="title" placeholder="Contoh: Siswa Kelas 6 SD" class="w-full bg-gray-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-bold text-[#006064]" required>
                    </div>
                </div>

                {{-- Pesan Testimoni --}}
                <div class="space-y-2">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Pesan Testimoni</label>
                    <textarea name="message" rows="4" placeholder="Tuliskan pengalaman belajar siswa di sini..." class="w-full bg-gray-50 border-none rounded-[2rem] px-6 py-4 focus:ring-2 focus:ring-[#FFC107] transition-all font-medium text-gray-600 italic" required></textarea>
                </div>

                {{-- Upload Foto (Wajib) --}}
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4">Foto Testimoni (Gaya Foto Kegiatan)</label>
                    <div class="bg-teal-50/50 p-8 rounded-[2rem] border-2 border-dashed border-teal-100 flex flex-col items-center justify-center text-center">
                        <div class="bg-white p-4 rounded-2xl shadow-sm mb-4">
                            <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-700 cursor-pointer" required>
                        <p class="mt-2 text-[9px] text-gray-400 italic uppercase tracking-wider">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="pt-6">
                    <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 rounded-2xl transition-all hover:scale-[1.02] shadow-lg shadow-yellow-500/20 uppercase tracking-[0.2em] text-xs">
                        Publish Testimoni Sekarang
                    </button>
                    <a href="{{ route('admin.testimonials.index') }}" class="block text-center mt-6 text-gray-400 text-[10px] font-bold uppercase tracking-widest hover:text-[#006064] transition-colors italic">← Kembali ke Daftar</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>