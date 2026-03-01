<x-admin-layout>
    <div class="max-w-4xl mx-auto py-10 px-4">
        
        {{-- HEADER: Editor System Style --}}
        <div class="mb-12">
            <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-3 italic">Editor System</h4>
            <h2 class="text-4xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                Tambah Program <span class="text-teal-500/50">Baru</span>
            </h2>
            <p class="text-gray-400 mt-4 font-bold italic text-xs uppercase tracking-widest flex items-center">
                <span class="w-8 h-[2px] bg-[#FFC107] mr-3"></span> Buat kategori belajar baru untuk BimbelinAja
            </p>
        </div>

        {{-- FORM CONTAINER: Premium Curves --}}
        <div class="bg-white rounded-[4rem] p-10 md:p-16 shadow-2xl shadow-teal-900/5 border border-gray-100 relative overflow-hidden">
            
            {{-- Dekorasi Latar Belakang (Aksen Teal) --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-teal-50/30 rounded-bl-full -z-0 opacity-50"></div>

            <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12 relative z-10">
                @csrf

                {{-- INPUT: Nama Program --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Nama Program Belajar</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Contoh: SD, SMP, SMA atau Kursus Intensif"
                           class="w-full p-6 rounded-[2rem] bg-gray-50 border-2 border-transparent focus:border-[#FFC107] focus:bg-white font-bold text-[#006064] transition-all shadow-inner outline-none">
                    @error('name')
                        <p class="text-red-500 text-[10px] font-black italic ml-2 mt-2 uppercase">{{ $message }}</p>
                    @enderror
                </div>

                {{-- INPUT: Visual Ikon --}}
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-[#006064] tracking-widest ml-2 italic">Identitas Visual (Ikon PNG/SVG)</label>
                    <div class="w-full">
                        <label for="icon" class="flex flex-col items-center justify-center w-full h-56 border-2 border-dashed border-teal-100 rounded-[3rem] cursor-pointer bg-teal-50/20 hover:bg-teal-50 hover:border-[#FFC107] transition-all group overflow-hidden relative">
                            <div id="preview-container" class="hidden absolute inset-0 bg-white flex items-center justify-center p-8 z-10">
                                <img id="icon-preview" src="#" class="max-h-full w-auto object-contain">
                            </div>
                            
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <div class="bg-white p-5 rounded-full shadow-sm mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-10 h-10 text-teal-200 group-hover:text-[#FFC107] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] text-gray-400 font-black uppercase italic tracking-widest mb-1">Klik untuk upload ikon baru</p>
                                <p class="text-[8px] text-gray-300 font-bold uppercase tracking-wider">PNG, SVG, atau JPG (Maks. 2MB)</p>
                            </div>
                            <input id="icon" type="file" name="icon" class="hidden" required onchange="previewImage(this)" />
                        </label>
                        @error('icon')
                            <p class="text-red-500 text-[10px] font-black italic ml-2 mt-2 uppercase">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTION BUTTONS: Dual Premium Layout --}}
                <div class="pt-12 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6 relative z-10">
                    
                    {{-- TOMBOL BATAL: Red Ghost Style --}}
                    <a href="{{ route('admin.programs.index') }}" 
                       class="w-full md:w-auto flex items-center justify-center gap-3 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white px-10 py-6 rounded-[2rem] font-black uppercase text-[10px] tracking-[0.2em] italic transition-all shadow-sm hover:shadow-xl hover:shadow-red-500/20 group">
                        <svg class="w-4 h-4 transition-transform group-hover:rotate-90 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <span>Batal & Kembali</span>
                    </a>
                    
                    {{-- TOMBOL SIMPAN: Signature Style --}}
                    <button type="submit" 
                            class="w-full md:w-auto bg-[#006064] hover:bg-teal-900 text-white font-black px-16 py-6 rounded-[2rem] shadow-2xl shadow-teal-900/30 uppercase tracking-[0.3em] text-[10px] italic transition-all active:scale-95 flex items-center justify-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Simpan Program Baru
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script Preview Gambar --}}
    <script>
        function previewImage(input) {
            const preview = document.getElementById('icon-preview');
            const container = document.getElementById('preview-container');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    container.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-admin-layout>