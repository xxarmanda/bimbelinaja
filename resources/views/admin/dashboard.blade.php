<x-admin-layout>
    <div class="p-8 bg-[#F8FAFC] min-h-screen">

        {{-- HEADER --}}
        <div class="mb-10 flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight uppercase italic">
                    Admin <span class="text-teal-600">Control Center</span>
                </h1>
                <p class="text-slate-500 text-[10px] mt-1 font-bold uppercase tracking-widest italic">
                    Monitoring Sistem Bimbel Secara Real-Time
                </p>
            </div>
        </div>

        {{-- ===== ROW 1: DATA OPERASIONAL UTAMA ===== --}}
        <h3 class="text-xs font-black uppercase tracking-[0.3em] text-gray-400 mb-4 italic">
            Statistik Operasional
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">

            @php
                $cards = [
                    ['label'=>'Total Pendaftaran','value'=>$counts['transactions'] ?? 0,'bg'=>'bg-sky-500','route'=>'admin.transactions.index'],
                    ['label'=>'Pesan Masuk','value'=>$counts['messages'] ?? 0,'bg'=>'bg-emerald-500','route'=>'admin.messages.index'],
                    ['label'=>'Pengajar','value'=>$counts['tutors'] ?? 0,'bg'=>'bg-amber-400','route'=>'admin.tutors.index','text'=>'text-[#006064]'],
                    ['label'=>'Program','value'=>$counts['programs'] ?? 0,'bg'=>'bg-rose-500','route'=>'admin.programs.index'],
                    ['label'=>'Mata Pelajaran','value'=>$counts['subprograms'] ?? 0,'bg'=>'bg-indigo-600','route'=>'admin.sub-programs.index'],
                ];
            @endphp

            @foreach($cards as $card)
                <div class="rounded-2xl overflow-hidden shadow-lg transition-all hover:brightness-105 {{ $card['bg'] }}">
                    <div class="p-6 {{ $card['text'] ?? 'text-white' }}">
                        <h3 class="text-4xl font-black italic">{{ $card['value'] }}</h3>
                        <p class="text-[9px] font-black uppercase tracking-widest mt-1 italic opacity-90">
                            {{ $card['label'] }}
                        </p>
                    </div>
                    <a href="{{ route($card['route']) }}"
                       class="block bg-black/10 py-2 text-center text-white/90 text-[8px] font-black uppercase tracking-[0.2em] hover:bg-black/20 transition-all italic">
                        Kelola Data →
                    </a>
                </div>
            @endforeach

        </div>

        {{-- ===== ROW 3: DATA TERBARU ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

            {{-- PENDAFTARAN TERBARU --}}
            <div class="bg-white rounded-[2.5rem] shadow border border-gray-100 overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-black text-[#006064] uppercase italic tracking-tighter">
                        Pendaftaran Terbaru
                    </h3>
                </div>

                <div class="divide-y">
                    @forelse($recentTransactions as $trx)
                        <div class="p-6 flex justify-between items-center hover:bg-teal-50/40 transition">
                            <div>
                                <p class="font-black text-[#006064] italic text-sm">
                                    {{ $trx->name }}
                                </p>
                                <p class="text-[9px] text-gray-400 font-bold uppercase italic">
                                    {{ $trx->created_at->diffForHumans() }}
                                </p>
                            </div>
                            <a href="{{ route('admin.transactions.show',$trx->id) }}"
                               class="text-[9px] font-black uppercase tracking-widest text-teal-600">
                                Detail →
                            </a>
                        </div>
                    @empty
                        <p class="p-6 text-xs italic text-gray-400 text-center">
                            Belum ada pendaftaran terbaru
                        </p>
                    @endforelse
                </div>
            </div>

            {{-- PESAN TERBARU --}}
            <div class="bg-white rounded-[2.5rem] shadow border border-gray-100 overflow-hidden">
                <div class="p-6 border-b bg-gray-50">
                    <h3 class="font-black text-[#006064] uppercase italic tracking-tighter">
                        Pesan Kriktik & Saran Terbaru
                    </h3>
                </div>

                <div class="divide-y">
                    @forelse($recentMessages as $msg)
                        <div class="p-6 hover:bg-teal-50/40 transition">
                            <p class="font-black text-[#006064] italic text-sm">
                                {{ $msg->name }}
                            </p>
                            <p class="text-[9px] text-gray-400 font-bold italic truncate">
                                {{ $msg->message }}
                            </p>
                        </div>
                    @empty
                        <p class="p-6 text-xs italic text-gray-400 text-center">
                            Belum ada pesan masuk
                        </p>
                    @endforelse
                </div>
            </div>

        </div>

    </div>
</x-admin-layout>