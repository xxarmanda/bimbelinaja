<x-admin-layout>
    <div class="space-y-12">
        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                    Manajemen Mata Pelajaran
                </h2>
                <p class="text-gray-500 mt-2 font-medium italic text-xs uppercase tracking-widest flex items-center">
                    <span class="w-8 h-[1px] bg-teal-200 mr-2"></span> Terbagi Berdasarkan Jenjang Sekolah
                </p>
            </div>
            
            <a href="{{ route('admin.sub-programs.create') }}" class="inline-flex items-center justify-center bg-[#006064] hover:bg-teal-950 text-white font-black px-10 py-5 rounded-[2rem] transition-all shadow-2xl shadow-teal-900/20 uppercase tracking-widest text-[10px] italic active:scale-95">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Mata Pelajaran
            </a>
        </div>

        {{-- NOTIFIKASI --}}
        @if(session('success'))
            <div class="bg-[#006064] text-white p-5 rounded-[2rem] font-bold italic shadow-xl flex items-center animate-fade-in">
                <span class="mr-3">✅</span> {{ session('success') }}
            </div>
        @endif

        {{-- LOGIKA PENGELOMPOKAN (GROUPING) --}}
        @php
            // Mengelompokkan data berdasarkan nama Program (Jenjang)
            $groupedPrograms = $subPrograms->groupBy(function($item) {
                return $item->program->name ?? 'Lainnya';
            });
        @endphp

        @forelse($groupedPrograms as $jenjang => $items)
            <div class="space-y-6">
                {{-- JENJANG HEADING --}}
                <div class="flex items-center space-x-4">
                    <div class="bg-[#FFC107] text-[#006064] px-6 py-2 rounded-full font-black uppercase italic text-xs shadow-lg shadow-yellow-500/20 tracking-widest">
                        Jenjang {{ $jenjang }}
                    </div>
                    <div class="h-[2px] flex-1 bg-gray-100 rounded-full"></div>
                    <span class="text-[10px] font-black text-gray-300 uppercase italic">{{ $items->count() }} Materi</span>
                </div>

                {{-- GRID KARTU PER JENJANG --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($items as $item)
                        <div class="bg-white border border-gray-50 rounded-[3.5rem] p-8 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group relative overflow-hidden">
                            {{-- Dekorasi Belakang --}}
                            <div class="absolute top-0 right-0 w-24 h-24 bg-teal-50/50 rounded-bl-[3.5rem] -z-0 opacity-0 group-hover:opacity-100 transition-opacity"></div>

                            <div class="flex items-start justify-between mb-8 relative z-10">
                                {{-- Ikon --}}
                                <div class="w-20 h-20 bg-gray-50 rounded-[2rem] flex items-center justify-center p-5 group-hover:bg-[#FFC107]/10 transition-all duration-500">
                                    @if($item->image)
                                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <span class="text-3xl">📖</span>
                                    @endif
                                </div>
                                
                                {{-- Aksi (Hanya Menyisakan Tombol Hapus) --}}
                                <div class="flex space-x-2">
                                    <form action="{{ route('admin.sub-programs.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus permanen materi ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-11 h-11 flex items-center justify-center bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all shadow-sm group/btn">
                                            <svg class="w-5 h-5 transition-transform group-hover/btn:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div class="relative z-10">
                                <h3 class="text-xl font-black text-[#006064] uppercase tracking-tighter mb-1 italic leading-tight">{{ $item->name }}</h3>
                                <p class="text-[#FFC107] text-sm font-black italic mb-6 tracking-wide">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                
                                <div class="flex items-center text-gray-300 text-[9px] font-black uppercase tracking-[0.2em] border-t border-gray-50 pt-4">
                                    <svg class="w-3 h-3 mr-2 text-teal-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Update {{ $item->updated_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="col-span-full py-32 flex flex-col items-center justify-center bg-gray-50 rounded-[4rem] border-4 border-dashed border-gray-100">
                <div class="bg-white p-6 rounded-full shadow-sm mb-6">
                    <span class="text-6xl">📚</span>
                </div>
                <h3 class="text-xl font-black text-gray-400 uppercase tracking-widest italic">Belum Ada Data Mata Pelajaran</h3>
                <p class="text-gray-300 text-[10px] font-bold mt-2 uppercase">Silakan klik tombol "Tambah Mata Pelajaran" di atas.</p>
            </div>
        @endforelse
    </div>
</x-admin-layout>