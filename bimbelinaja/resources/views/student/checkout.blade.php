<x-checkout-layout>
    <div class="py-12 bg-[#F8FAFC] min-h-screen" 
         x-data="{ 
            basePrice: {{ $program->price }},
            participants: 1,
            sessions: 4,
            method: 'offline',
            regFee: 95000,

            // FUNGSI INTI: Menangkap data dari URL kalkulator agar sinkron
            init() {
                const params = new URLSearchParams(window.location.search);
                // Menarik data dan memastikan formatnya angka (parseInt)
                this.participants = parseInt(params.get('participants')) || 1;
                this.sessions = parseInt(params.get('sessions')) || 4;
                this.method = params.get('method') || 'offline';
            },

            // Hitung Biaya Paket (Tanpa Registrasi)
            calcPackageTotal() {
                let sessionFactor = this.sessions / 4;
                // Logika: Peserta 1 (100%), setiap tambahan peserta (+50%)
                let participantFactor = 1 + ((this.participants - 1) * 0.5); 
                return (this.basePrice * sessionFactor) * participantFactor;
            },

            formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID').format(amount);
            }
         }">
        
        @include('layouts.nav')

        <div class="max-w-4xl mx-auto px-6">
            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf
                {{-- Data Hidden untuk dikirim ke Database --}}
                <input type="hidden" name="sub_program_id" value="{{ $program->id }}">
                <input type="hidden" name="sessions" :value="sessions">
                <input type="hidden" name="participants_count" :value="participants">
                <input type="hidden" name="learning_method" :value="method">

                {{-- SECTION 1: DATA FORM --}}
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-100 mb-8">
                    <h3 class="text-xl font-black text-[#006064] uppercase italic mb-8">1. Data Pendaftaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <input type="text" name="parent_name" required placeholder="Nama Orang Tua" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm outline-none focus:border-[#006064]">
                        <input type="tel" name="phone" required placeholder="WhatsApp Aktif (08xx)" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm outline-none focus:border-[#006064]">
                    </div>
                    
                    <div class="space-y-4">
                        {{-- Input Nama Siswa Muncul Sesuai Jumlah Peserta --}}
                        <template x-for="i in participants" :key="i">
                            <div class="flex gap-3">
                                <div class="bg-[#006064] text-white w-12 h-12 rounded-xl flex items-center justify-center font-bold" x-text="i"></div>
                                <input type="text" name="participant_names[]" required :placeholder="'Nama Lengkap Siswa ' + i" 
                                       class="flex-1 bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 focus:border-[#006064] outline-none font-bold text-sm">
                            </div>
                        </template>
                    </div>
                </div>

                {{-- SECTION 2: TABEL RINCIAN BIAYA (SINKRON DENGAN PAKET) --}}
                <div class="bg-white rounded-[2.5rem] p-8 md:p-12 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-black text-[#006064] uppercase italic mb-8 italic">2. Rincian Biaya & Pendaftaran</h3>
                    
                    <div class="overflow-hidden rounded-3xl border border-gray-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-[#006064] text-white uppercase text-[11px] tracking-widest italic">
                                    <th class="p-5">Deskripsi</th>
                                    <th class="p-5">Informasi</th>
                                    <th class="p-5 text-right">Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="text-xs font-bold text-gray-700 italic">
                                <tr class="border-b border-gray-100">
                                    <td class="p-5 text-teal-800">Kategori Program Les</td>
                                    <td class="p-5">{{ $program->program->name }}</td>
                                    <td class="p-5 text-right">-</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="p-5 text-teal-800">Cara Belajar</td>
                                    <td class="p-5" x-text="method === 'offline' ? 'Les Privat Tatap Muka' : 'Les Privat Online'"></td>
                                    <td class="p-5 text-right">-</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="p-5 text-teal-800">Paket Les / Bulan</td>
                                    <td class="p-5" x-text="sessions + ' sesi / bulan'"></td>
                                    <td class="p-5 text-right">-</td>
                                </tr>
                                <tr class="border-b border-gray-100">
                                    <td class="p-5 text-teal-800">Jumlah Peserta</td>
                                    <td class="p-5" x-text="participants + ' Peserta'"></td>
                                    <td class="p-5 text-right">-</td>
                                </tr>
                                <tr class="bg-gray-50/50">
                                    <td class="p-5 text-teal-800">Biaya Registrasi</td>
                                    <td class="p-5 text-gray-400 font-medium">Khusus Peserta Baru</td>
                                    <td class="p-5 text-right text-[#006064]">Rp 95.000</td>
                                </tr>
                                <tr class="bg-teal-50/30">
                                    <td colspan="2" class="p-6 text-right font-black uppercase tracking-tighter text-[#006064] text-sm">Total Estimasi Biaya / Bulan</td>
                                    <td class="p-6 text-right text-2xl font-black text-[#006064]">
                                        Rp <span x-text="formatRupiah(calcPackageTotal() + regFee)"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-10">
                        <button type="submit" class="w-full bg-[#006064] hover:bg-teal-900 text-white font-black py-7 rounded-[2.5rem] shadow-xl transition-all transform active:scale-95 uppercase tracking-widest italic text-sm">
                            Konfirmasi & Bayar Sekarang ➡️
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-checkout-layout>