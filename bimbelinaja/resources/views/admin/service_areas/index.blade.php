<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- HEADER: Elegant & Professional --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">Area Layanan Ciayumajakuning</h2>
                <div class="flex items-center mt-3 space-x-3">
                    <p class="text-gray-400 font-bold italic text-[10px] uppercase tracking-widest">Master Data Wilayah Operasional Tutor</p>
                    <span class="bg-teal-50 text-teal-600 px-3 py-1 rounded-full text-[9px] font-black uppercase italic border border-teal-100">
                        Total: {{ $areas->count() }} Wilayah
                    </span>
                </div>
            </div>
            {{-- Tombol Refresh Mewah --}}
            <a href="{{ route('admin.service-areas.index') }}" class="flex items-center bg-white border border-gray-100 text-gray-400 hover:text-[#006064] px-6 py-3 rounded-2xl font-black uppercase text-[9px] tracking-widest italic transition-all shadow-sm hover:shadow-md">
                <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                Refresh Data
            </a>
        </div>

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="bg-[#006064] text-white p-5 rounded-[2rem] font-bold italic shadow-xl animate-fade-in flex items-center">
                <span class="mr-3">✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-10 items-start">
            
            {{-- FORM CREATE (KIRI): Sticky & Clean --}}
            <div class="lg:col-span-1 bg-white rounded-[3.5rem] p-10 shadow-sm border border-gray-50 space-y-10 sticky top-6">
                <h3 class="text-xl font-black text-[#006064] uppercase italic border-b-4 border-[#FFC107] pb-2 inline-block tracking-tighter">Tambah Wilayah</h3>
                
                <form action="{{ route('admin.service-areas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2 tracking-widest">Nama Kota / Kabupaten</label>
                        <input type="text" name="city_name" placeholder="Contoh: Kota Cirebon" required 
                               class="w-full p-5 rounded-[1.5rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2 tracking-widest">Daftar Kecamatan / Wilayah</label>
                        <textarea name="description" rows="5" placeholder="Sebutkan wilayah jangkauan..." required 
                                  class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-medium text-gray-600 italic transition-all shadow-inner outline-none resize-none leading-relaxed"></textarea>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2 tracking-widest">Ikon Lokasi (Pin)</label>
                        <div class="bg-teal-50/30 p-8 rounded-[2rem] border-2 border-dashed border-teal-100 flex flex-col items-center hover:bg-teal-50 transition-colors">
                            <input type="file" name="icon" class="text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white cursor-pointer">
                            <p class="mt-4 text-[8px] font-black text-gray-400 uppercase italic">Format PNG/SVG (Maks. 1MB)</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#006064] hover:bg-teal-950 text-white font-black py-6 rounded-2xl shadow-xl shadow-teal-900/20 uppercase tracking-[0.2em] text-[11px] italic transition-all active:scale-95">
                        Simpan Area Baru
                    </button>
                </form>
            </div>

            {{-- LIST AREA (KANAN): Premium Card Grid --}}
            <div class="lg:col-span-2 grid md:grid-cols-2 gap-8">
                @forelse($areas as $area)
                    <div class="bg-white p-10 rounded-[4rem] shadow-sm border border-gray-100 group relative hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between overflow-hidden">
                        
                        {{-- Dekorasi Latar --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-teal-50/50 rounded-bl-[4rem] -z-0 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                        <div class="relative z-10">
                            <div class="flex items-start justify-between mb-8">
                                <div class="flex items-center space-x-5">
                                    {{-- Pin Ikon Mewah --}}
                                    <div class="w-16 h-16 bg-teal-50/50 rounded-[1.5rem] flex items-center justify-center text-[#006064] group-hover:bg-[#FFC107] group-hover:text-white transition-all duration-500 shadow-sm group-hover:rotate-6">
                                        @if($area->icon)
                                            <img src="{{ asset('storage/'.$area->icon) }}" class="w-8 h-8 object-contain">
                                        @else
                                            <span class="text-2xl">📍</span>
                                        @endif
                                    </div>
                                    <h4 class="font-black text-[#006064] text-xl uppercase italic leading-none tracking-tighter">{{ $area->city_name }}</h4>
                                </div>
                                
                                {{-- TOMBOL HAPUS (MERAH) --}}
                                <form action="{{ route('admin.service-areas.destroy', $area->id) }}" method="POST" onsubmit="return confirm('Hapus wilayah {{ $area->city_name }}?')" class="opacity-0 group-hover:opacity-100 transition-opacity">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-400 hover:bg-red-500 hover:text-white rounded-xl transition-all shadow-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </form>
                            </div>
                            
                            {{-- Deskripsi Wilayah --}}
                            <div class="space-y-3">
                                <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest italic leading-none">Cakupan Wilayah:</p>
                                <p class="text-[12px] text-gray-500 leading-relaxed italic border-l-4 border-teal-50 pl-5 py-1">{{ $area->description }}</p>
                            </div>
                        </div>
                        
                        {{-- TOMBOL EDIT (TEAL) --}}
                        <div class="mt-10 relative z-10">
                            <a href="{{ route('admin.service-areas.edit', $area->id) }}" 
                               class="w-full flex items-center justify-center bg-teal-50 text-[#006064] font-black uppercase text-[10px] py-4 rounded-2xl tracking-[0.2em] italic hover:bg-[#006064] hover:text-white transition-all shadow-sm hover:shadow-xl hover:shadow-teal-900/10">
                                Edit Detail Wilayah 
                                <svg class="w-3 h-3 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
                        <div class="bg-white p-6 rounded-full shadow-sm mb-6">
                            <span class="text-6xl">📍</span>
                        </div>
                        <p class="text-gray-400 font-black uppercase text-[11px] tracking-[0.4em] italic leading-relaxed">Belum ada area layanan terdaftar.<br>Silakan tambah wilayah di panel sebelah kiri.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-admin-layout>