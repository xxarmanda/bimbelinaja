<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- HEADER: Mewah & Italic --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">Manajemen Media Coverage</h2>
                <p class="text-gray-400 font-bold uppercase text-[10px] tracking-widest mt-2 italic">Kelola Branding & Kepercayaan Publik</p>
            </div>
            <div class="hidden md:block">
                <span class="bg-teal-50 text-teal-600 px-4 py-2 rounded-full text-[10px] font-black uppercase italic border border-teal-100">
                    Total: {{ $medias->count() }} Media
                </span>
            </div>
        </div>

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="bg-[#006064] text-white p-5 rounded-[2rem] font-bold italic shadow-xl animate-fade-in flex items-center">
                <span class="mr-3">✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-10 items-start">
            
            {{-- FORM TAMBAH (KIRI) --}}
            <div class="lg:col-span-1 bg-white rounded-[3rem] p-10 shadow-sm border border-gray-50 space-y-8 sticky top-6">
                <h3 class="text-xl font-black text-[#006064] uppercase italic border-b-4 border-[#FFC107] pb-2 inline-block">Tambah Media</h3>
                
                <form action="{{ route('admin.media-coverages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Nama Media Nasional</label>
                        <input type="text" name="name" placeholder="Contoh: IDN Times" required 
                               class="w-full p-5 rounded-2xl bg-gray-50 border-none font-bold text-[#006064] focus:ring-2 focus:ring-[#FFC107] transition-all shadow-inner">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Link Berita (Opsional)</label>
                        <input type="url" name="url" placeholder="https://tribunnews.com/berita-kita" 
                               class="w-full p-5 rounded-2xl bg-gray-50 border-none font-bold text-[#006064] focus:ring-2 focus:ring-[#FFC107] transition-all shadow-inner">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Logo Media (PNG/SVG)</label>
                        <div class="bg-teal-50/30 p-8 rounded-[2.5rem] border-2 border-dashed border-teal-100 flex flex-col items-center text-center transition-colors hover:bg-teal-50/50">
                            <input type="file" name="logo" required class="text-[9px] text-gray-400 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white">
                            <p class="mt-4 text-[8px] font-black text-gray-400 uppercase italic">Gunakan logo berwarna & transparan</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 rounded-2xl shadow-xl shadow-yellow-500/20 uppercase tracking-widest text-[11px] italic transition-all active:scale-95">
                        Simpan Logo Media
                    </button>
                </form>
            </div>

            {{-- DAFTAR MEDIA (KANAN) --}}
            <div class="lg:col-span-2 grid grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($medias as $media)
                    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 group relative hover:shadow-2xl transition-all duration-500 flex flex-col items-center justify-between">
                        
                        {{-- Preview Logo Berwarna --}}
                        <div class="h-20 flex items-center justify-center mb-6 w-full p-4 bg-gray-50 rounded-[2rem] group-hover:bg-white transition-colors">
                            <img src="{{ asset('storage/'.$media->logo) }}" 
                                 class="max-h-full max-w-full object-contain transition-transform duration-700 group-hover:scale-110">
                        </div>
                        
                        <div class="text-center space-y-1 mb-6">
                            <h4 class="font-black text-[#006064] text-xs uppercase italic tracking-tighter">{{ $media->name }}</h4>
                            <p class="text-[9px] text-gray-400 font-bold uppercase truncate w-32 mx-auto">Verified Media</p>
                        </div>
                        
                        {{-- ACTION BUTTONS --}}
                        <div class="flex items-center space-x-3 w-full">
                            <a href="{{ route('admin.media-coverages.edit', $media->id) }}" 
                               class="flex-1 text-center bg-teal-50 text-teal-600 font-black text-[9px] py-3 rounded-xl uppercase italic hover:bg-[#006064] hover:text-white transition-all">
                                Edit
                            </a>
                            
                            <form action="{{ route('admin.media-coverages.destroy', $media->id) }}" method="POST" 
                                  onsubmit="return confirm('Hapus media {{ $media->name }}?')" class="flex-1">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="w-full text-center bg-red-50 text-red-400 font-black text-[9px] py-3 rounded-xl uppercase italic hover:bg-red-500 hover:text-white transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>

                        {{-- Akses Cepat URL --}}
                        @if($media->url)
                            <a href="{{ $media->url }}" target="_blank" class="absolute top-4 right-4 text-gray-300 hover:text-[#FFC107]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full py-32 bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
                        <div class="bg-gray-100 p-6 rounded-full mb-6 text-gray-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="text-gray-400 font-black uppercase text-[10px] tracking-[0.3em] italic">Data Media Belum Tersedia</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-admin-layout>