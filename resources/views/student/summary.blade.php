<x-checkout-layout>
    <div class="py-20 bg-gray-50 min-h-screen flex flex-col items-center">
        
        {{-- BAGIAN ATAS (Sesuai Screenshot 005050) --}}
        <div class="bg-white rounded-[4rem] shadow-2xl p-12 md:p-16 max-w-4xl w-full border border-gray-100 mb-10">
            <div class="flex flex-col md:flex-row items-center gap-10 border-b border-gray-50 pb-10">
                <div class="w-40 h-40 rounded-[3rem] overflow-hidden shadow-xl border-4 border-gray-50">
                    <img src="{{ asset('storage/' . $transaction->subProgram->image) }}" class="w-full h-full object-cover">
                </div>
                <div class="text-center md:text-left">
                    <p class="text-[10px] font-black text-teal-600 uppercase tracking-widest italic mb-2">Mata Pelajaran Terpilih</p>
                    <h2 class="text-4xl font-black text-[#006064] uppercase italic tracking-tighter leading-none mb-4">
                        {{ $transaction->subProgram->name }}
                    </h2>
                    <div class="inline-block bg-teal-50 px-6 py-3 rounded-2xl">
                        <p class="text-[#006064] font-black text-3xl italic">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- TABEL RINCIAN LENGKAP (Sesuai Screenshot 011331) --}}
            <div class="mt-10 overflow-hidden rounded-3xl border border-gray-100 shadow-sm">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#006064] text-white uppercase text-[11px] tracking-widest">
                            <th class="p-5 font-black">Deskripsi</th>
                            <th class="p-5 font-black">Informasi</th>
                            <th class="p-5 text-right font-black">Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-bold text-[#006064] italic">
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Kategori Program Les</td>
                            <td class="p-5">{{ $transaction->subProgram->program->name }}</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Bahasa Pengantar (Bilingual?)</td>
                            <td class="p-5">{{ $details['language'] ?? 'Indonesia' }}</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Cara Belajar</td>
                            <td class="p-5">{{ $details['method'] === 'offline' ? 'Les Privat Tatap Muka' : 'Les Privat Online' }}</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Paket Les / Bulan</td>
                            <td class="p-5">{{ $details['sessions'] ?? 4 }} sesi / bulan</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Durasi Les / Sesi</td>
                            <td class="p-5">{{ $details['duration'] ?? '60 menit / sesi' }}</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="border-b border-gray-50">
                            <td class="p-5 text-teal-800">Jumlah Peserta</td>
                            <td class="p-5">{{ count($details['detail_siswa'] ?? [1]) }} Peserta</td>
                            <td class="p-5 text-right">-</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-5 text-teal-800">Biaya Registrasi Per Peserta</td>
                            <td class="p-5 font-medium text-gray-400">1x di Awal, Khusus Peserta Baru</td>
                            <td class="p-5 text-right">Rp 95.000</td>
                        </tr>
                        <tr class="bg-teal-50/50">
                            <td colspan="2" class="p-6 text-right font-black uppercase tracking-tighter text-teal-900 text-sm">
                                Estimasi Biaya Les / Bulan
                            </td>
                            <td class="p-6 text-right text-xl font-black text-teal-900">
                                Rp {{ number_format($transaction->amount + ($details['registration_fee'] ?? 95000), 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- TOMBOL KONFIRMASI (Sesuai Screenshot 005050) --}}
            <div class="mt-12 text-center">
                <a href="{{ route('pembayaran.instruksi', $transaction->id) }}" 
                   class="inline-flex w-full items-center justify-center bg-[#006064] hover:bg-teal-900 text-white font-black py-7 rounded-[2.5rem] shadow-2xl transition-all gap-3 uppercase italic tracking-widest text-lg">
                    Konfirmasi & Bayar Sekarang
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
                </a>
            </div>
        </div>
    </div>
</x-checkout-layout>