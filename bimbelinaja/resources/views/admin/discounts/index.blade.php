<x-admin-layout>
    <div class="space-y-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter">
                    {{ __('Manajemen Promo & Diskon') }}
                </h2>
                <p class="text-gray-500 mt-1 font-medium">Kelola banner promo yang akan muncul di halaman depan BimbelinAja.</p>
            </div>
            
            <a href="{{ route('discounts.create') }}" class="inline-flex items-center justify-center bg-[#006064] hover:bg-teal-950 text-white font-black px-8 py-4 rounded-2xl transition shadow-lg shadow-teal-900/20 uppercase tracking-widest text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Tambah Promo
            </a>
        </div>

        @if(session('success'))
            <div class="bg-teal-50 border-l-4 border-[#006064] p-4 rounded-xl flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-[#006064] mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-[#006064] font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-[#006064] hover:text-teal-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($discounts as $promo)
                <div class="bg-white border border-gray-100 rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 group">
                    <div class="relative h-52 overflow-hidden">
                        <img src="{{ asset('storage/' . $promo->banner_image) }}" alt="{{ $promo->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        
                        <div class="absolute top-4 right-4 flex space-x-2">
                            <form action="{{ route('discounts.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-3 bg-white/90 backdrop-blur text-red-500 rounded-2xl shadow-sm hover:bg-red-500 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="p-8">
                        <h3 class="text-xl font-black text-[#006064] uppercase tracking-tighter mb-2">{{ $promo->title }}</h3>
                        <p class="text-gray-500 text-sm font-medium line-clamp-2 mb-4">{{ $promo->description }}</p>
                        
                        <div class="flex items-center text-gray-400 text-xs font-bold uppercase tracking-widest">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Diperbarui {{ $promo->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 flex flex-col items-center justify-center bg-gray-50 rounded-[3rem] border-2 border-dashed border-gray-200">
                    <span class="text-6xl mb-4">📢</span>
                    <h3 class="text-xl font-bold text-gray-400">Belum ada promo yang aktif.</h3>
                    <p class="text-gray-400 mt-2 text-center px-6">Bagikan penawaran menarik kepada siswa BimbelinAja sekarang.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>