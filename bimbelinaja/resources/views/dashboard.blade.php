<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic mb-8 tracking-tighter">Status Belajar Saya</h2>
            
            <div class="grid gap-6">
                @forelse($myTransactions as $t)
                    <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="flex items-center gap-6">
                            <div class="w-20 h-20 rounded-2xl bg-teal-50 flex items-center justify-center font-black text-2xl">📚</div>
                            <div>
                                <h4 class="text-xl font-black text-gray-800 uppercase">{{ $t->subProgram->name ?? 'Program Les' }}</h4>
                                <div class="mt-2">
                                    {{-- LOGIKA STATUS --}}
                                    @if($t->status == 'success')
                                        <span class="bg-green-100 text-green-600 px-4 py-1 rounded-full text-[10px] font-black uppercase italic">Terverifikasi ✅</span>
                                    @else
                                        <span class="bg-yellow-100 text-yellow-600 px-4 py-1 rounded-full text-[10px] font-black uppercase italic tracking-widest">Menunggu Verifikasi ⏳</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- GERBANG TOMBOL BELAJAR --}}
                        <div>
                            @if($t->status == 'success')
                                <a href="{{ route('belajar.index', $t->sub_program_id) }}" class="bg-[#006064] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-teal-900/20">
                                    Mulai Belajar 🚀
                                </a>
                            @else
                                <div class="bg-gray-100 text-gray-300 px-8 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] italic cursor-not-allowed border border-gray-200">
                                    Akses Terkunci 🔒
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-[3rem] p-20 text-center border-2 border-dashed">
                        <p class="text-gray-300 font-black uppercase italic">Belum ada program yang kamu ikuti.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>