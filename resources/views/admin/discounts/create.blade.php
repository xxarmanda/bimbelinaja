<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter">Buat Promo Baru</h2>
            <p class="text-gray-500 font-medium">Siapkan penawaran menarik untuk meningkatkan minat belajar siswa.</p>
        </div>

        <form action="{{ route('discounts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-8">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="font-bold text-[#006064] ml-1 uppercase text-xs tracking-widest">Judul Promo</label>
                    <input type="text" name="title" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#006064] font-medium" placeholder="Contoh: Promo Gajian" required>
                </div>

                <div class="space-y-2">
                    <label class="font-bold text-[#006064] ml-1 uppercase text-xs tracking-widest">Persentase (%)</label>
                    <input type="number" name="percentage" min="1" max="100" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#006064] font-medium" placeholder="Contoh: 20" required>
                </div>
            </div>

            <div class="space-y-2">
                <label class="font-bold text-[#006064] ml-1 uppercase text-xs tracking-widest">Deskripsi / S&K</label>
                <textarea name="description" rows="4" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#006064] font-medium" placeholder="Jelaskan detail promo dan syarat ketentuannya..." required></textarea>
            </div>

            <div class="space-y-2">
                <label class="font-bold text-[#006064] ml-1 uppercase text-xs tracking-widest">Banner Promo (Rasio 16:9)</label>
                <div class="relative group">
                    <input type="file" name="banner_image" class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-[#006064] file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#006064] file:text-white hover:file:bg-teal-900" required>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase mt-1 ml-1">* Format: JPG, PNG (Maks 2MB)</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-[#006064] text-white py-5 rounded-3xl font-black uppercase tracking-[0.2em] shadow-xl shadow-teal-900/20 hover:bg-teal-950 hover:-translate-y-1 transition-all duration-300">
                    Tayangkan Promo Sekarang
                </button>
                <a href="{{ route('discounts.index') }}" class="block text-center mt-6 text-gray-400 font-bold text-xs uppercase tracking-widest hover:text-[#006064] transition">Batal & Kembali</a>
            </div>
        </form>
    </div>
</x-admin-layout>