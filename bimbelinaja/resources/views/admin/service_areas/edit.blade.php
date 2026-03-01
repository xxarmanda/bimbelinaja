<x-admin-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        {{-- HEADER: Editor System Style --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-2 italic">Editor System</h4>
                <h2 class="text-4xl lg:text-5xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                    Update <span class="text-teal-500/50">Wilayah</span>
                </h2>
                {{-- PERBAIKAN: Menggunakan $area --}}
                <p class="text-gray-400 font-bold italic text-xs uppercase tracking-widest mt-3 flex items-center">
                    <span class="w-8 h-[2px] bg-[#FFC107] mr-3"></span> Wilayah: {{ $area->city_name }}
                </p>
            </div>
            <a href="{{ route('admin.service-areas.index') }}" 
               class="bg-white border border-gray-100 text-gray-400 hover:text-[#006064] px-6 py-3 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all shadow-sm hover:shadow-md italic">
                ← Kembali
            </a>
        </div>

        {{-- FORM EDIT: Premium Curves & Shadows --}}
        <form action="{{ route('admin.service-areas.update', $area->id) }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-[4rem] p-10 md:p-16 shadow-2xl shadow-teal-900/5 border border-gray-50 space-y-12 relative overflow-hidden">
            
            @csrf
            @method('PUT')

            {{-- Dekorasi Latar --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/30 rounded-bl-full -z-0 opacity-50"></div>

            <div class="grid lg:grid-cols-2 gap-12 relative z-10">
                <div class="space-y-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2 tracking-widest">Nama Kota / Kabupaten</label>
                        <input type="text" name="city_name" value="{{ $area->city_name }}" required 
                               class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2 tracking-widest">Daftar Kecamatan</label>
                        <textarea name="description" rows="5" required 
                                  class="w-full p-6 rounded-[2.5rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-medium text-gray-600 italic transition-all shadow-inner outline-none resize-none leading-relaxed">{{ $area->description }}</textarea>
                    </div>
                </div>

                <div class="flex flex-col items-center justify-center space-y-6">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-teal-50 rounded-[3rem] blur-xl opacity-50 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative w-48 h-48 bg-white rounded-[3rem] flex items-center justify-center p-8 border border-gray-100 shadow-xl">
                            @if($area->icon)
                                <img src="{{ asset('storage/'.$area->icon) }}" class="max-h-full w-auto object-contain transition-transform group-hover:scale-110">
                            @else
                                <span class="text-5xl">📍</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="text-center space-y-4">
                        <label class="block text-[10px] font-black text-gray-300 uppercase italic tracking-widest">Ganti Ikon Lokasi</label>
                        <input type="file" name="icon" class="text-[10px] text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                <a href="{{ route('admin.service-areas.index') }}" 
                   class="w-full md:w-auto flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-10 py-5 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] italic transition-all shadow-sm group">
                    ✕ Batal
                </a>
                
                <button type="submit" 
                        class="w-full md:w-auto bg-[#006064] hover:bg-teal-900 text-white font-black px-16 py-5 rounded-[2rem] shadow-2xl shadow-teal-900/30 uppercase tracking-[0.3em] text-[10px] italic transition-all active:scale-95">
                    Update Detail Wilayah
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>