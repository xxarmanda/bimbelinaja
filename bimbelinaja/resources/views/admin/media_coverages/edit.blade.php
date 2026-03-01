<x-admin-layout>
    <div class="max-w-5xl mx-auto py-10 px-4">
        {{-- HEADER: Bergaya Elegant & Bold --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-2 italic">Editor System</h4>
                <h2 class="text-4xl lg:text-5xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                    Update <span class="text-teal-500/50">Media</span>
                </h2>
                <p class="text-gray-400 font-bold italic text-xs uppercase tracking-widest mt-3 flex items-center">
                    <span class="w-8 h-[2px] bg-gray-200 mr-3"></span> Liputan: {{ $media_coverage->name }}
                </p>
            </div>
            <a href="{{ route('admin.media-coverages.index') }}" 
               class="bg-white border border-gray-100 text-gray-400 hover:text-[#006064] px-6 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all shadow-sm hover:shadow-md italic">
                ← Kembali ke Daftar
            </a>
        </div>

        {{-- FORM EDIT: Full Color & Premium Shadows --}}
        <form action="{{ route('admin.media-coverages.update', $media_coverage->id) }}" 
              method="POST" 
              enctype="multipart/form-data" 
              class="bg-white rounded-[4rem] p-10 md:p-16 shadow-2xl shadow-teal-900/5 border border-gray-50 relative overflow-hidden">
            
            @csrf
            @method('PUT')

            {{-- Dekorasi Latar Belakang --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/30 rounded-bl-full -z-0 opacity-50"></div>

            <div class="grid lg:grid-cols-2 gap-16 relative z-10">
                
                {{-- KIRI: DATA INPUT --}}
                <div class="space-y-10">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Nama Media Nasional</label>
                        <input type="text" name="name" value="{{ $media_coverage->name }}" required 
                               class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">URL Link Berita</label>
                        <div class="relative">
                            <input type="url" name="url" value="{{ $media_coverage->url }}" 
                                   class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none pl-14">
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 text-gray-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.828a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                        <p class="text-[9px] text-gray-400 italic ml-4 uppercase font-bold">* Masukkan link lengkap (http:// atau https://)</p>
                    </div>
                </div>

                {{-- KANAN: PREVIEW LOGO (FULL COLOR) --}}
                <div class="flex flex-col items-center justify-center space-y-8">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-gradient-to-tr from-teal-50 to-yellow-50 rounded-[3.5rem] blur-2xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative bg-white p-10 rounded-[3rem] shadow-xl border border-gray-100 flex items-center justify-center w-64 h-64 overflow-hidden">
                            @if($media_coverage->logo)
                                {{-- LOGO BERWARNA: Tanpa class grayscale --}}
                                <img src="{{ asset('storage/'.$media_coverage->logo) }}" 
                                     class="max-h-full max-w-full object-contain transition-transform duration-500 group-hover:scale-110">
                            @endif
                        </div>
                    </div>
                    
                    <div class="w-full max-w-xs space-y-4">
                        <label class="block text-center text-[10px] font-black uppercase text-gray-400 italic tracking-widest">Ganti Logo Media</label>
                        <div class="relative">
                            <input type="file" name="logo" 
                                   class="w-full text-[10px] text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-2xl file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-900 cursor-pointer">
                        </div>
                    </div>
                </div>
            </div>

            {{-- TOMBOL UPDATE: Besar & Bold --}}
            <div class="mt-16 pt-10 border-t border-gray-50 flex justify-center">
                <button type="submit" 
                        class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black px-16 py-7 rounded-[2.5rem] shadow-2xl shadow-yellow-500/40 uppercase tracking-[0.3em] text-sm italic transition-all active:scale-95">
                    Update Data Liputan Media
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>