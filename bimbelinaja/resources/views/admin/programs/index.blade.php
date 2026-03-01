<x-admin-layout>
    <div class="space-y-10">
        {{-- Header & Tombol Tambah --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic">
                    {{ __('Manajemen Program Les') }}
                </h2>
                <p class="text-gray-500 mt-1 font-medium italic">Kelola kategori program bimbingan belajar BimbelinAja.</p>
            </div>
            <a href="{{ route('admin.programs.create') }}" class="inline-flex items-center justify-center bg-[#006064] hover:bg-teal-950 text-white font-black px-8 py-4 rounded-2xl transition shadow-lg shadow-teal-900/20 uppercase tracking-widest text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                Tambah Program
            </a>
        </div>

        @if(session('success'))
            <div class="bg-teal-50 border-l-4 border-[#006064] p-4 rounded-xl flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-[#006064] mr-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    <span class="text-[#006064] font-bold italic">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-[#006064] hover:text-teal-900">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        @endif

        {{-- DAFTAR PROGRAM CARD --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($programs as $program)
                <div class="bg-white border border-gray-100 rounded-[3rem] p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 group relative overflow-hidden">
                    {{-- Dekorasi Latar Belakang --}}
                    <div class="absolute top-0 right-0 w-40 h-40 bg-teal-50/50 rounded-bl-[3rem] -z-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                    <div class="relative z-10 flex items-start justify-between mb-8">
                        {{-- Ikon Program --}}
                        <div class="w-24 h-24 bg-teal-50/50 rounded-[2rem] flex items-center justify-center p-5 group-hover:bg-[#FFC107]/20 transition-colors duration-500">
                            @if($program->icon)
                                <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->name }}" class="w-full h-full object-contain transition-transform duration-500 group-hover:scale-110">
                            @else
                                <span class="text-4xl transition-transform duration-500 group-hover:scale-110">📚</span>
                            @endif
                        </div>
                        
                        {{-- TOMBOL AKSI BERWARNA --}}
                        <div class="flex items-center space-x-3">
                            {{-- Tombol Edit (Teal) --}}
                            <a href="{{ route('admin.programs.edit', $program) }}" class="w-12 h-12 flex items-center justify-center bg-teal-50 hover:bg-[#006064] text-[#006064] hover:text-white rounded-2xl transition-all shadow-sm hover:shadow-md group/btn">
                                <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>
                            
                            {{-- Tombol Hapus (Merah) --}}
                            <form action="{{ route('admin.programs.destroy', $program) }}" method="POST" onsubmit="return confirm('Hapus program {{ $program->name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-12 h-12 flex items-center justify-center bg-red-50 hover:bg-red-500 text-red-400 hover:text-white rounded-2xl transition-all shadow-sm hover:shadow-md group/btn">
                                    <svg class="w-6 h-6 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Info Program --}}
                    <div class="relative z-10">
                        <h3 class="text-2xl font-black text-[#006064] uppercase tracking-tighter italic mb-3 leading-none">{{ $program->name }}</h3>
                        <div class="flex items-center text-gray-400 text-xs font-bold italic uppercase tracking-wider">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Dibuat {{ $program->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-32 flex flex-col items-center justify-center bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200">
                    <div class="bg-white p-6 rounded-full shadow-sm mb-6">
                        <span class="text-6xl">📭</span>
                    </div>
                    <h3 class="text-xl font-black text-gray-400 uppercase italic tracking-widest">Belum ada program.</h3>
                    <p class="text-gray-400 mt-2 font-bold italic text-xs uppercase tracking-wider">Klik tombol "Tambah Program" di atas.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-admin-layout>