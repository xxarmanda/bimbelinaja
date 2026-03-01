<x-admin-layout>
    <div class="p-10 pb-32">
        <div class="mb-10 flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                    Kelola Hubungi Kami
                </h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
                    Sesuaikan informasi kontak, jadwal, dan lokasi BimbelinAja
                </p>
            </div>
            <a href="{{ route('contact.public') }}" target="_blank" class="bg-teal-50 text-[#006064] px-6 py-3 rounded-xl font-black uppercase text-[9px] tracking-widest hover:bg-teal-100 transition-all flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                Lihat Halaman
            </a>
        </div>

        <form action="{{ route('admin.settings.video.update') }}" method="POST" class="space-y-10">
            @csrf @method('PATCH')

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                
                {{-- 1. HERO & SUPPORT SECTION --}}
                <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-8">
                    <h3 class="text-[10px] font-black text-[#006064] uppercase tracking-widest border-b pb-4 italic">Bagian Atas & Support</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Judul Hero (Gunakan span untuk warna kuning)</label>
                            <input type="text" name="contact_hero_title" value="{{ $settings['contact_hero_title'] ?? 'HUBUNGI <span class=\"text-[#FFC107]\">KAMI</span>' }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm">
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Sub-judul Hero</label>
                            <input type="text" name="contact_hero_subtitle" value="{{ $settings['contact_hero_subtitle'] ?? 'BANTUAN & LAYANAN KONSULTASI BIMBELINAJA' }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Label Chat (Support)</label>
                                <input type="text" name="contact_support_title" value="{{ $settings['contact_support_title'] ?? 'DIRECT SUPPORT' }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl p-3 font-bold text-xs uppercase">
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Judul Chat</label>
                                <input type="text" name="contact_chat_title" value="{{ $settings['contact_chat_title'] ?? 'CHAT KONSULTAN KAMI' }}" class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl p-3 font-bold text-xs uppercase">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Deskripsi Chat</label>
                            <textarea name="contact_chat_desc" rows="3" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-xs">{{ $settings['contact_chat_desc'] ?? 'Klik tombol di bawah untuk terhubung langsung dengan admin kami via WhatsApp.' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 2. JADWAL OPERASIONAL --}}
                <div class="bg-[#006064] p-10 rounded-[2.5rem] shadow-xl text-white space-y-8 border-b-[12px] border-teal-900">
                    <h3 class="text-[10px] font-black text-yellow-400 uppercase tracking-widest border-b border-white/10 pb-4 italic">Jadwal Operasional</h3>
                    <div class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-teal-300 uppercase ml-2">Senin - Jumat</label>
                            <input type="text" name="contact_mon_fri" value="{{ $settings['contact_mon_fri'] ?? '08:00 - 21:00' }}" class="w-full bg-white/10 border-2 border-white/10 rounded-2xl p-4 font-black text-sm text-white outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-teal-300 uppercase ml-2">Sabtu</label>
                            <input type="text" name="contact_sat" value="{{ $settings['contact_sat'] ?? '09:00 - 18:00' }}" class="w-full bg-white/10 border-2 border-white/10 rounded-2xl p-4 font-black text-sm text-white outline-none">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-teal-300 uppercase ml-2">Minggu (Atau Libur)</label>
                            <input type="text" name="contact_sun" value="{{ $settings['contact_sun'] ?? 'Libur (Slow Respon)' }}" class="w-full bg-white/10 border-2 border-white/10 rounded-2xl p-4 font-black text-sm text-white outline-none">
                        </div>
                    </div>
                </div>

                {{-- 3. ALAMAT & GOOGLE MAPS --}}
                <div class="lg:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-8">
                    <h3 class="text-[10px] font-black text-[#006064] uppercase tracking-widest border-b pb-4 italic">Alamat & Lokasi Map</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Alamat Lengkap (Gunakan <br> untuk pindah baris)</label>
                                <textarea name="contact_address" rows="4" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-xs uppercase">{{ $settings['contact_address'] ?? 'Gg. Kamboja Jl. Sonopakis Lor No.186 RT.07, <br>Ngestiharjo, Kec. Kasihan, Kabupaten Bantul, DIY 55182' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Link Peta (Google Maps URL)</label>
                                <input type="text" name="contact_map_url" value="{{ $settings['contact_map_url'] ?? '#' }}" placeholder="https://maps.google.com/..." class="w-full bg-gray-50 border-2 border-gray-100 rounded-xl p-4 font-bold text-xs">
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[9px] font-black text-gray-400 uppercase mb-2 ml-2">Google Maps Embed Link (Src Only)</label>
                                <textarea name="contact_map_embed" rows="6" placeholder="https://www.google.com/maps/embed?pb=..." class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-[10px]">{{ $settings['contact_map_embed'] ?? '' }}</textarea>
                                <p class="mt-2 text-[8px] text-gray-400 font-bold italic">*Hanya masukkan atribut 'src' dari kode embed Google Maps. contoh: ngambil link di sematkan peta link nya ukuran petanya ngambil yang kecil dan hapus bagian "src" dan widthnya</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-400 text-[#006064] px-12 py-5 rounded-[2rem] font-black uppercase text-xs tracking-widest shadow-2xl hover:bg-yellow-500 transition-all active:scale-95">
                    Perbarui Informasi Kontak 
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>