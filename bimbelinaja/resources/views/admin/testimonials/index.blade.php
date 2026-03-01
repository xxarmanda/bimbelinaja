<x-admin-layout>
    <div class="p-10 pb-32 max-w-7xl mx-auto">
        
        {{-- SECTION 1: PENGATURAN TEKS KARIR (GRID LAYOUT) --}}
        <div class="mb-24">
            <div class="mb-10">
                <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                    Pengaturan <span class="text-[#FFC107]">Halaman Karir</span>
                </h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Kelola teks keunggulan & alur bergabung tutor</p>
            </div>
            
            <form action="{{ route('admin.settings.video.update') }}" method="POST">
                @csrf @method('PATCH')
                
                <div class="grid lg:grid-cols-4 gap-10 items-start">
                    
                    {{-- KOLOM KIRI: FORM INPUT (3/4 LEBAR) --}}
                    <div class="lg:col-span-3 space-y-10">
                        
                        {{-- Kenapa Mengajar & Fitur --}}
                        <div class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100 space-y-8">
                            <div class="flex items-center space-x-3">
                                <div class="bg-[#006064] p-2 rounded-lg text-white font-black text-[10px]">WHY</div>
                                <h3 class="font-black text-[#006064] uppercase tracking-tighter italic">Informasi Kenapa Mengajar</h3>
                            </div>
                            
                            <input type="text" name="career_why_title" value="{{ $settings['career_why_title'] ?? '' }}" class="w-full bg-gray-50 border-2 border-transparent rounded-2xl p-4 font-bold text-[#006064] outline-none focus:border-[#006064] transition-all shadow-inner">
                            
                            <div class="grid md:grid-cols-2 gap-8">
                                <div class="p-6 bg-[#F8FAFC] rounded-[2.5rem] space-y-4">
                                    <label class="block text-[9px] font-black text-gray-400 uppercase italic">Fitur 1 (Kiri)</label>
                                    <input type="text" name="career_f1_title" value="{{ $settings['career_f1_title'] ?? '' }}" placeholder="Judul Fitur" class="w-full bg-white border-2 border-gray-100 rounded-xl p-3 font-black text-[10px] uppercase">
                                    <textarea name="career_f1_desc" rows="3" placeholder="Deskripsi" class="w-full bg-white border-2 border-gray-100 rounded-xl p-3 text-xs italic font-medium">{{ $settings['career_f1_desc'] ?? '' }}</textarea>
                                </div>
                                <div class="p-6 bg-[#F8FAFC] rounded-[2.5rem] space-y-4">
                                    <label class="block text-[9px] font-black text-gray-400 uppercase italic">Fitur 2 (Kanan)</label>
                                    <input type="text" name="career_f2_title" value="{{ $settings['career_f2_title'] ?? '' }}" placeholder="Judul Fitur" class="w-full bg-white border-2 border-gray-100 rounded-xl p-3 font-black text-[10px] uppercase">
                                    <textarea name="career_f2_desc" rows="3" placeholder="Deskripsi" class="w-full bg-white border-2 border-gray-100 rounded-xl p-3 text-xs italic font-medium">{{ $settings['career_f2_desc'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- Kriteria & CTA Box (TEAL) --}}
                        <div class="grid md:grid-cols-2 gap-10">
                            <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 space-y-4">
                                <h3 class="text-[10px] font-black text-[#006064] uppercase tracking-widest border-b pb-4 mb-2 italic">Kriteria Utama Kami</h3>
                                <input type="text" name="career_criteria_title" value="{{ $settings['career_criteria_title'] ?? '' }}" placeholder="Judul Kriteria" class="w-full bg-gray-50 rounded-xl p-3 text-xs font-black uppercase italic mb-2">
                                @foreach(['career_c1', 'career_c2', 'career_c3', 'career_c4'] as $c)
                                    <input type="text" name="{{ $c }}" value="{{ $settings[$c] ?? '' }}" placeholder="Kriteria..." class="w-full bg-gray-50 border-none rounded-xl p-3 text-[10px] font-bold italic">
                                @endforeach
                            </div>

                            <div class="bg-[#006064] p-8 rounded-[3rem] shadow-2xl space-y-6 text-white relative overflow-hidden">
                                <div class="relative z-10">
                                    <h3 class="text-[10px] font-black text-[#FFC107] uppercase tracking-[0.3em] mb-4 italic">Alur Bergabung (CTA)</h3>
                                    <input type="text" name="career_cta_title" value="{{ $settings['career_cta_title'] ?? '' }}" placeholder="Judul CTA" class="w-full bg-white/10 border-2 border-white/10 rounded-xl p-3 font-black text-xs uppercase mb-4 outline-none">
                                    <div class="space-y-2">
                                        @foreach(['career_step_1', 'career_step_2', 'career_step_3'] as $idx => $step)
                                            <input type="text" name="{{ $step }}" value="{{ $settings[$step] ?? '' }}" placeholder="Langkah {{ $idx+1 }}" class="w-full bg-white/5 border border-white/10 rounded-lg p-2.5 text-[9px] font-bold">
                                        @endforeach
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-white/10">
                                        <label class="text-[8px] font-black text-teal-300 uppercase block mb-1">WhatsApp URL</label>
                                        <input type="text" name="career_whatsapp_url" value="{{ $settings['career_whatsapp_url'] ?? '' }}" class="w-full bg-[#FFC107] border-none rounded-lg p-2.5 text-[#006064] font-black text-[9px]">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KOLOM KANAN: TOMBOL SIMPAN (STICKY) --}}
                    <div class="lg:col-span-1">
                        <div class="sticky top-32 bg-[#FFC107] p-10 rounded-[3.5rem] shadow-2xl shadow-yellow-500/20 text-[#006064] text-center border-4 border-white">
                            <div class="bg-[#006064] w-16 h-16 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <h4 class="font-black uppercase italic tracking-tighter text-xl mb-4">Simpan<br>Pembaruan</h4>
                            <p class="text-[9px] font-bold leading-relaxed mb-10 opacity-70 uppercase tracking-widest">Klik tombol di bawah untuk memproses semua teks karir baru.</p>
                            
                            <button type="submit" class="w-full bg-[#006064] text-white font-black py-5 rounded-2xl shadow-xl hover:bg-teal-900 transition-all hover:scale-105 active:scale-95 uppercase tracking-widest text-[9px]">
                                Update Teks Karir ✨
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <hr class="border-gray-100 mb-20">

        {{-- SECTION 2: DAFTAR TESTIMONI --}}
        <div class="flex justify-between items-center mb-10">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">Manajemen Testimoni</h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Daftar kutipan inspiratif dari para tutor BimbelinAja</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}" class="bg-[#006064] text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-teal-900 shadow-lg transition-all">
                + Tambah Testimoni
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $t)
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative group hover:shadow-xl transition-all duration-500">
                <div class="flex items-center gap-4 mb-6">
                    <div class="relative">
                        @if($t->photo)
                            <img src="{{ asset('storage/' . $t->photo) }}" class="w-16 h-16 rounded-full object-cover border-4 border-teal-50 shadow-sm relative z-10">
                        @else
                            <div class="w-16 h-16 rounded-full bg-[#006064] flex items-center justify-center text-white font-black uppercase text-xl relative z-10">{{ substr($t->name, 0, 1) }}</div>
                        @endif
                        <div class="absolute -right-1 -bottom-1 w-6 h-6 bg-[#FFC107] rounded-full z-20 flex items-center justify-center border-2 border-white">
                            <svg class="w-3 h-3 text-[#006064]" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.154c-2.41 1.056-4.012 3.616-4.012 5.842h4v9.997l-9.87-.003z"/></svg>
                        </div>
                    </div>
                    <div>
                        <h4 class="font-black text-[#006064] uppercase text-sm tracking-tighter">{{ $t->name }}</h4>
                        <p class="text-[9px] font-bold text-teal-600 uppercase italic tracking-widest">{{ $t->role }}</p>
                    </div>
                </div>
                <p class="text-gray-500 text-xs italic font-medium leading-relaxed mb-10">"{{ $t->quote }}"</p>
                
                <div class="absolute bottom-8 right-8">
                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-50 text-red-500 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-admin-layout>