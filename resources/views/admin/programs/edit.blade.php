<x-admin-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        
        {{-- HEADER: Editor System Style --}}
        <div class="mb-12">
            <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-3 italic">Editor System</h4>
            <h2 class="text-4xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                Edit Program <span class="text-teal-50/50">Les</span>
            </h2>
            <p class="text-gray-400 mt-4 font-bold italic text-xs uppercase tracking-widest flex items-center">
                <span class="w-8 h-[2px] bg-[#FFC107] mr-3"></span> Sedang Mengedit: {{ $program->name }}
            </p>
        </div>

        {{-- FORM CONTAINER: Premium Curves --}}
        <div class="bg-white rounded-[4rem] p-10 md:p-16 shadow-2xl shadow-teal-900/5 border border-gray-50 relative overflow-hidden">
            
            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/30 rounded-bl-full -z-0 opacity-50"></div>

            <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-12 relative z-10">
                @csrf
                @method('PATCH')

                {{-- INPUT: Nama Program --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Nama Program Belajar</label>
                    <input type="text" name="name" value="{{ old('name', $program->name) }}" required
                           class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    @error('name')
                        <p class="text-red-500 text-[10px] font-black italic ml-2 mt-2 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                {{-- INPUT: Visual Ikon --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Identitas Visual (Ikon Aktif)</label>
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        
                        {{-- Preview Ikon Sekarang --}}
                        <div class="relative group">
                            <div class="absolute -inset-2 bg-teal-50 rounded-[2.5rem] blur opacity-50"></div>
                            <div class="relative w-32 h-32 bg-white rounded-[2.5rem] flex items-center justify-center p-6 border border-gray-100 shadow-xl transition-transform group-hover:rotate-3">
                                {{-- PERBAIKAN: Memanggil path langsung dari database tanpa 'storage/' --}}
                                @if($program->icon && file_exists(public_path($program->icon)))
                                    <img src="{{ asset($program->icon) }}" class="max-h-full w-auto object-contain transition-transform group-hover:scale-110 duration-500">
                                @else
                                    <span class="text-4xl">📚</span>
                                @endif
                            </div>
                            <p class="text-center text-[8px] font-black text-gray-400 uppercase italic mt-4">Ikon Saat Ini</p>
                        </div>

                        {{-- Box Upload Baru --}}
                        <div class="flex-1 w-full">
                            <label for="icon" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-teal-100 rounded-[2.5rem] cursor-pointer bg-teal-50/20 hover:bg-teal-50 hover:border-[#FFC107] transition-all group">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-2 text-teal-200 group-hover:text-[#FFC107] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <p class="text-[9px] font-black text-gray-400 uppercase italic tracking-widest">Klik untuk ganti ikon baru</p>
                                </div>
                                <input id="icon" type="file" name="icon" class="hidden" />
                            </label>
                            
                            <div class="mt-4 ml-2">
                            {{-- Info Format: Hitam Pekat --}}
                            <p class="text-[9px] text-black font-black uppercase tracking-widest italic">
                                * Format: JPG, PNG, JPEG
                            </p>
                            
                            {{-- Info Ukuran: Hitam Pekat --}}
                            <p class="text-[9px] text-black font-black uppercase tracking-widest italic mt-1">
                                * Ukuran Maksimal: 2 MB
                            </p>

                            {{-- Peringatan Larangan: Merah Tajam --}}
                            <p class="text-[9px] text-red-600 font-black uppercase tracking-widest italic mt-1">
                                Dilarang Upload "PDF Atau File Dokumen Lainnya"
                            </p>
                        </div>
                            @error('icon')
                                <p class="text-red-500 text-[10px] font-black italic ml-2 mt-2 uppercase">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="pt-12 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                    <a href="{{ route('admin.programs.index') }}" 
                       class="w-full md:w-auto flex items-center justify-center gap-3 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-10 py-6 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] italic transition-all shadow-sm hover:shadow-xl hover:shadow-red-500/20 group">
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-90 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
</x-admin-layout>