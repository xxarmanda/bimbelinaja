<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Bimbel - {{ $subProgram->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] font-sans antialiased text-[#006064]">

    @include('layouts.nav')

    {{-- KONTEN UTAMA --}}
    <main class="max-w-4xl mx-auto py-16 px-4 md:px-6" x-data="{ 
        basePrice: {{ $subProgram->price }}, 
        sessions: 4,
        participants: 1,
        learningMethod: 'offline',
        regFee: {{ $config->registration_fee ?? 95000 }},
        showSummary: false, 
        
        total() {
            let sessionFactor = this.sessions / 4;
            let participantFactor = 1 + ((this.participants - 1) * 0.5); 
            return (this.basePrice * sessionFactor) * participantFactor;
        },
        
        formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID').format(amount);
        }
    }">

        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-black uppercase italic tracking-tighter leading-none">Form Pendaftaran <br class="md:hidden">Les bimbel</h1>
            <p class="text-gray-500 font-bold italic mt-4 text-sm">Program: <span class="text-[#006064]">{{ $subProgram->name }}</span></p>
            <div class="w-20 h-1 bg-[#FFC107] mx-auto mt-4 rounded-full"></div>
        </div>

        {{-- FORM UTAMA --}}
            <form action="{{ route('transaction.store') }}" method="POST" class="space-y-8">
            @csrf
            <input type="hidden" name="sub_program_id" value="{{ $subProgram->id }}">

            <!-- SINKRON DATA ALPINE KE BACKEND -->
            <input type="hidden" name="learning_method" :value="learningMethod">
            <input type="hidden" name="sessions" :value="sessions">

            {{-- BOX PILIHAN PAKET --}}
            <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-2xl border border-gray-100 p-8 md:p-16 space-y-10">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-center font-black mb-4 uppercase text-[10px] tracking-widest text-gray-400 italic">Cara Belajar</label>
                        <select name="learning_method" x-model="learningMethod" @change="showSummary = true" class="w-full border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064] transition-all">
                            <option value="offline">Offline (Tutor ke Rumah)</option>
                            <option value="online">Online (Zoom/Meet)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-center font-black mb-4 uppercase text-[10px] tracking-widest text-gray-400 italic">Paket Les / Bulan</label>
                        <select name="sessions" x-model="sessions" @change="showSummary = true" class="w-full border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064] transition-all">
                            <option value="4">4 sesi / bulan</option>
                            <option value="8">8 sesi / bulan</option>
                            <option value="12">12 sesi / bulan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-center font-black mb-4 uppercase text-[10px] tracking-widest text-gray-400 italic">Jumlah Peserta</label>
                        <select name="participants_count" x-model="participants" @change="showSummary = true" class="w-full border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064] transition-all">
                            <template x-for="i in 10" :key="i">
                                <option :value="i" x-text="i + (i == 1 ? ' Peserta (Privat)' : ' Peserta (Kelompok)')"></option>
                            </template>
                        </select>
                    </div>
                </div>
            </div>

            {{-- BOX DATA SISWA --}}
            <div class="bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-2xl border border-gray-100 p-8 md:p-16 space-y-8">
                <h3 class="text-xl font-black uppercase italic border-b-4 border-[#FFC107] inline-block mb-4">Lengkapi Data Pendaftaran</h3>
                
                <div class="space-y-6">
                    <template x-for="i in parseInt(participants)" :key="i">
                        <div class="p-6 md:p-8 bg-teal-50/30 rounded-[2rem] border border-teal-100 space-y-6">
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-widest italic" x-text="'Informasi Siswa Ke-' + i"></p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="student_names[]" required :placeholder="'Nama Lengkap Siswa ' + i" class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064]" @input="showSummary = true">
                                <input type="text" name="nicknames[]" required :placeholder="'Nama Panggilan Siswa ' + i" class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064]">
                                
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Tanggal Lahir</label>
                                    <input type="date" name="birth_dates[]" required class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064] transition-all">
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Gender Siswa</label>
                                    <select name="student_genders[]" required class="w-full bg-white border-2 border-gray-100 rounded-xl p-4 font-bold text-sm outline-none focus:border-[#006064]">
                                        <option value="">Pilih Gender</option>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </template>

                    {{-- Kontak & Jadwal --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">No. WhatsApp Aktif</label>
                            <input type="tel" name="whatsapp" required placeholder="Contoh: 08xx" class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064]">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Kota / Kabupaten</label>
                            <input type="text" name="city" required placeholder="Contoh: Bantul" class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064]">
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Alamat Lengkap Tinggal</label>
                            <textarea name="address" required placeholder="Contoh: Gg. Kamboja Jl. Sonopakis Lor No.186 RT07..." class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-[2.5rem] px-8 py-6 outline-none transition-all font-bold text-sm text-[#006064] h-32 resize-none"></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Preferensi Gender Tutor</label>
                            <select name="tutor_gender_pref" required class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064] appearance-none cursor-pointer">
                                <option value="">Pilih Preferensi Gender</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                                <option value="Bebas">Bebas (Mana Saja)</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Rencana Les Dimulai</label>
                            <input type="date" name="start_date" required class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064]">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Rencana Jadwal</label>
                            <textarea name="schedule" required placeholder="Contoh: Senin & Kamis jam 16.00" class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064] h-16 resize-none"></textarea>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Sifat Jadwal</label>
                            <select name="schedule_type" required class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm text-[#006064] appearance-none cursor-pointer">
                                <option value="Fleksibel">Sifat Jadwal: Fleksibel</option>
                                <option value="Jadwal Tetap">Sifat Jadwal: Jadwal Tetap</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Pesan Tambahan untuk Tutor (Opsional)</label>
                            <textarea name="additional_message" placeholder="Tuliskan catatan khusus di sini..." class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-[2.5rem] px-8 py-6 outline-none transition-all font-bold text-sm text-[#006064] h-32 resize-none"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            {{-- BOX RINGKASAN BIAYA --}}
            <div x-show="showSummary" 
                 x-cloak
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-y-10"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-2xl border border-gray-100 p-8 md:p-16">
                
                <h3 class="text-xl font-black uppercase italic border-b-4 border-[#FFC107] inline-block mb-8">Estimasi Investasi Belajar</h3>

                <div class="overflow-x-auto rounded-3xl border border-gray-100 mb-8">
                    <table class="w-full text-left border-collapse min-w-[500px]">
                        <thead>
                            <tr class="bg-[#006064] text-white uppercase text-[10px] tracking-widest italic">
                                <th class="p-5">Deskripsi</th>
                                <th class="p-5">Informasi</th>
                                <th class="p-5 text-right">Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs font-bold text-gray-700 italic">
                            <tr class="border-b border-gray-50">
                                <td class="p-5 text-gray-400">Program Les</td>
                                <td class="p-5">{{ $subProgram->name }}</td>
                                <td class="p-5 text-right">-</td>
                            </tr>
                            <tr class="border-b border-gray-50">
                                <td class="p-5 text-gray-400">Paket & Metode</td>
                                <td class="p-5" x-text="sessions + ' Sesi / Bulan (' + learningMethod + ')'"></td>
                                <td class="p-5 text-right text-[#006064]">Rp <span x-text="formatRupiah(total())"></span></td>
                            </tr>
                            <tr class="bg-gray-50/50">
                                <td class="p-5 text-gray-400">Biaya Registrasi</td>
                                <td class="p-5 text-gray-300 font-medium">Khusus Siswa Baru (1x di Awal)</td>
                                <td class="p-5 text-right text-[#006064]">Rp <span x-text="formatRupiah(regFee)"></span></td>
                            </tr>
                            <tr class="bg-teal-50/30">
                                <td colspan="2" class="p-6 text-right font-black uppercase tracking-tighter text-[#006064] text-sm">Total Estimasi Bayar</td>
                                <td class="p-6 text-right text-2xl font-black text-[#006064]">
                                    Rp <span x-text="formatRupiah(total() + regFee)"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- TOMBOL SUBMIT --}}
                <button type="submit" class="w-full bg-[#006064] hover:bg-teal-900 text-white font-black py-7 rounded-[2rem] shadow-2xl transition-all transform active:scale-95 uppercase tracking-widest italic flex items-center justify-center gap-3">
                    <svg class="w-6 h-6 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Konfirmasi & Daftar Sekarang
                </button>
            </div>
        </form>
    </main>

    @include('layouts.footer')

</body>
</html>