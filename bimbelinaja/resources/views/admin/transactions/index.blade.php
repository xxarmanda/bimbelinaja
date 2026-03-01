<x-admin-layout>
    <div class="p-10 bg-[#FBFCFD] min-h-screen">
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-12 gap-6">
            <div>
                <h1 class="text-5xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                    Data Pendaftaran <span class="text-yellow-400">Masuk</span>
                </h1>
                <div class="flex items-center gap-3 mt-3">
                    <span class="h-[2px] w-12 bg-yellow-400"></span>
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-[0.3em]">
                        Panel Verifikasi Keuangan & Rekap Siswa
                    </p>
                </div>
            </div>
            
            <div class="flex gap-4">
                <div class="bg-white p-4 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4 px-6">
                    <div class="bg-teal-50 p-3 rounded-2xl text-[#006064]">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase leading-none mb-1">Total Pendaftar</p>
                        <p class="text-xl font-black text-[#006064]">{{ $transactions->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- BAR PENCARIAN & FILTER (Gaya Industrial) --}}
        <div class="mb-10 bg-white border-4 border-black p-6 shadow-[8px_8px_0px_0px_rgba(0,0,0,1)]">
            <form action="{{ route('admin.transactions.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                {{-- 1. Search Nama --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-black uppercase tracking-widest italic">Cari Nama Siswa</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama..." 
                           class="border-2 border-black p-3 font-bold text-xs focus:bg-yellow-50 outline-none">
                </div>

                {{-- 2. Filter Jenjang --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-black uppercase tracking-widest italic">Filter Jenjang</label>
                    <select name="program_id" class="border-2 border-black p-3 font-bold text-xs outline-none cursor-pointer">
                        <option value="">Semua Jenjang</option>
                        @foreach($programs as $p)
                            <option value="{{ $p->id }}" {{ request('program_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 3. Filter Status --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[10px] font-black uppercase tracking-widest italic">Status Bayar</label>
                    <select name="status" class="border-2 border-black p-3 font-bold text-xs outline-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="success" {{ request('status') == 'success' ? 'selected' : '' }}>Sudah Bayar</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Belum Bayar</option>
                    </select>
                </div>

                {{-- 4. Tombol --}}
                <div class="flex gap-2">
                    <button type="submit" class="flex-1 bg-black text-white font-black py-3 uppercase text-[10px] tracking-widest hover:bg-gray-800 transition-all shadow-[4px_4px_0px_0px_rgba(255,193,7,1)] active:shadow-none active:translate-x-1 active:translate-y-1">
                        Terapkan Filter
                    </button>
                    <a href="{{ route('admin.transactions.index') }}" class="px-5 bg-gray-100 border-2 border-black flex items-center justify-center hover:bg-red-500 hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    </a>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="mb-8 p-5 bg-[#006064] rounded-[2rem] text-white font-bold italic shadow-2xl shadow-teal-900/20 flex items-center animate-bounce">
                <span class="bg-white/20 p-2 rounded-full mr-4 text-xl">✅</span>
                <span class="tracking-wide uppercase text-xs">{{ session('success') }}</span>
            </div>
        @endif

        {{-- TABEL GAYA MICROSOFT EXCEL --}}
        <div class="bg-white border-4 border-black overflow-x-auto shadow-[8px_8px_0px_0px_rgba(0,0,0,0.1)]">
            <table class="w-full border-collapse border border-black text-sm">
                <thead>
                    <tr class="bg-gray-200 text-black font-black uppercase tracking-tighter text-center">
                        <th class="border-2 border-black p-4 w-16">ID</th>
                        <th class="border-2 border-black p-4 text-left">PROFIL SISWA</th>
                        <th class="border-2 border-black p-4">JENJANG</th> {{-- KOLOM BARU --}}
                        <th class="border-2 border-black p-4">PAKET</th>
                        <th class="border-2 border-black p-4 text-left font-black">KONTAK & KOTA</th>
                        <th class="border-2 border-black p-4 text-left">TOTAL BIAYA</th>
                        <th class="border-2 border-black p-4">STATUS</th>
                        <th class="border-2 border-black p-4 bg-yellow-400">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                        @php 
                            $n = json_decode($t->notes, true); 
                            $s = $n['detail_siswa'][0] ?? null;
                            $namaFix = $s['nama_lengkap'] ?? ($t->guest_name ?? 'Siswa');
                        @endphp
                        <tr class="hover:bg-teal-50 transition-colors">
                            <td class="border border-black p-4 text-center font-bold">#{{ $t->id }}</td>
                            <td class="border border-black p-4">
                                <p class="font-black text-blue-900 uppercase text-base leading-tight">{{ $namaFix }}</p>
                                <p class="text-[11px] italic text-gray-500">Panggilan: {{ $s['panggilan'] ?? '-' }}</p>
                            </td>
                            {{-- Tampilkan Jenjang Sekolah --}}
                            <td class="border border-black p-4 text-center">
                                <span class="bg-teal-50 text-[#006064] px-3 py-1 border border-black font-black text-[10px] uppercase">
                                    {{ $t->subProgram->program->name ?? '-' }}
                                </span>
                            </td>
                            <td class="border border-black p-4 text-center font-bold text-base">
                                {{ $t->sessions ?? ($n['sessions'] ?? '-') }} SESI
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">{{ $t->subProgram->name ?? '-' }}</p>
                            </td>
                            <td class="border border-black p-4">
                                <p class="font-black text-green-700 text-base">{{ $n['whatsapp'] ?? '-' }}</p>
                                <p class="text-[10px] uppercase font-bold text-gray-400">{{ $n['kota_kabupaten'] ?? '-' }}</p>
                            </td>
                            <td class="border border-black p-4 font-black text-base text-red-700">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                            <td class="border border-black p-4 text-center">
                                @if($t->status == 'success')
                                    <span class="text-teal-600 font-black italic text-[10px]">VERIFIED</span>
                                @else
                                    <span class="text-orange-500 font-black italic text-[10px] animate-pulse">PENDING...</span>
                                @endif
                            </td>

                            <td class="border border-black p-4">
                                <div class="flex flex-col gap-2">
                                    @if($t->proof_of_payment)
                                        <a href="{{ asset('storage/' . $t->proof_of_payment) }}" target="_blank" 
                                           class="bg-white text-black py-2 text-[10px] font-black uppercase text-center border border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:bg-gray-100 transition-all">
                                            🔍 CEK BUKTI
                                        </a>
                                    @else
                                        <span class="text-[8px] text-center font-bold text-gray-300 italic uppercase">Belum Bayar</span>
                                    @endif

                                    @if($t->status != 'success')
                                        <form action="{{ route('admin.transaction.verify', $t->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin sudah mengecek bukti dan menyetujui pendaftaran {{ $namaFix }}?')">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="w-full bg-yellow-400 text-black py-2 text-[10px] font-black uppercase border border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:shadow-none transition-all">
                                                ✅ ACC/TERIMA
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.transactions.show', $t->id) }}" 
                                       class="bg-blue-600 text-white py-2 text-[10px] font-black uppercase text-center border border-black shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] hover:bg-blue-700 transition-all">
                                        📄 DETAIL/PRINT
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="border border-black p-20 text-center font-black uppercase tracking-[0.5em] text-gray-300 italic">
                                Data Tidak Ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>