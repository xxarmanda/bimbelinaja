<x-guest-layout>
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2 bg-[#006064] relative overflow-hidden">
        
        {{-- DEKORASI LATAR BELAKANG GLOBAL --}}
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/5 rounded-full animate-pulse"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#FFC107]/10 rounded-full animate-bounce-slow"></div>

        {{-- SISI KIRI: KONTEN BRANDING & INFO SISTEM --}}
        <div class="hidden lg:flex flex-col justify-center px-24 relative z-10 border-r border-white/5 bg-black/10 backdrop-blur-md">
            
            {{-- Logo Area --}}
            <div class="bg-white p-6 rounded-[2.5rem] shadow-2xl inline-block mb-10 w-fit shadow-black/20 transform hover:rotate-6 transition-transform duration-500 border-4 border-teal-50">
                <svg class="w-16 h-16 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

            <h1 class="text-7xl font-black text-white uppercase tracking-tighter italic leading-[0.85] mb-6">
                Pusat <br> <span class="text-[#FFC107]">Kendali </span><span class="text-[#FFFFF]">Admin</span>
            </h1>

            {{-- ANIMASI TEXT MENGETIK --}}
            <div class="h-10 mb-12" x-data="{ 
                text: '', 
                fullText: 'Sistem Administrasi Pusat BimbelinAja — Gerbang Akses Terautentikasi',
                index: 0,
                init() {
                    let timer = setInterval(() => {
                        if (this.index < this.fullText.length) {
                            this.text += this.fullText.charAt(this.index);
                            this.index++;
                        } else { clearInterval(timer); }
                    }, 40);
                }
            }">
                <p class="text-teal-200 font-black text-xs uppercase tracking-[0.4em] italic border-l-4 border-[#FFC107] pl-6 py-2" x-text="text"></p>
            </div>

            {{-- DAFTAR FITUR SISTEM (PENYEMPURNAAN KONTEN KIRI) --}}
            <div class="space-y-8 max-w-md">
                <div class="flex items-start space-x-6 group">
                    <div class="bg-[#FFC107] p-3 rounded-2xl group-hover:scale-110 transition-transform shadow-lg shadow-yellow-500/20">
                        <svg class="w-6 h-6 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-black uppercase text-sm italic tracking-widest mb-1">Keamanan Enkripsi</h4>
                        <p class="text-teal-100/50 text-[10px] font-bold uppercase leading-relaxed tracking-wider">Akses data dilindungi dengan protokol keamanan tingkat tinggi.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-6 group">
                    <div class="bg-teal-500 p-3 rounded-2xl group-hover:scale-110 transition-transform shadow-lg shadow-teal-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-black uppercase text-sm italic tracking-widest mb-1">Data Real-Time</h4>
                        <p class="text-teal-100/50 text-[10px] font-bold uppercase leading-relaxed tracking-wider">Pantau pendaftaran siswa dan status pembayaran secara langsung.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-6 group">
                    <div class="bg-white/10 p-3 rounded-2xl group-hover:scale-110 transition-transform border border-white/10">
                        <svg class="w-6 h-6 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-white font-black uppercase text-sm italic tracking-widest mb-1">Manajemen Tutor</h4>
                        <p class="text-teal-100/50 text-[10px] font-bold uppercase leading-relaxed tracking-wider">Kelola profil pengajar dan kurikulum dalam satu dashboard tunggal.</p>
                    </div>
                </div>
            </div>

            <p class="mt-20 text-white/20 text-[8px] font-black uppercase tracking-[0.8em]">Bimbelinaja platform bimbel les @ 2026</p>
        </div>

        {{-- SISI KANAN: FORM LOGIN --}}
        <div class="flex flex-col justify-center items-center p-6 lg:p-24 relative z-10">
            
            {{-- Header Khusus Mobile --}}
            <div class="lg:hidden text-center mb-10">
                <div class="bg-white p-5 rounded-[2.2rem] shadow-xl inline-block mb-4 border-2 border-teal-50">
                    <svg class="w-12 h-12 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <h2 class="text-4xl font-black text-white uppercase italic tracking-tighter">Login <span class="text-[#FFC107]">Admin</span></h2>
            </div>

            {{-- Card Login Signature --}}
            <div class="w-full max-w-[480px] bg-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.7)] border-t-[16px] border-[#FFC107] rounded-[3.5rem] overflow-hidden transform transition-all duration-500 hover:shadow-yellow-500/10">
                
                <div class="px-10 md:px-16 py-14 md:py-20">
                    <div class="mb-10 text-center lg:text-left">
                        <h3 class="text-2xl font-black text-[#006064] uppercase tracking-tighter italic">Otorisasi <span class="text-teal-500">Masuk Admin</span></h3>
                        <p class="text-gray-400 font-bold text-[9px] uppercase tracking-widest mt-1 italic">Silakan lengkapi kredensial anda</p>
                    </div>

                    <x-auth-session-status class="mb-6 text-xs font-bold text-green-600" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" class="space-y-8">
                        @csrf

                        <div class="space-y-3 group">
                            <label class="font-black text-[#006064] uppercase text-[10px] tracking-[0.2em] ml-2 block opacity-50 group-focus-within:opacity-100 transition-opacity">Credential ID</label>
                            <input type="email" name="email" :value="old('email')" required autofocus 
                                   class="w-full p-5 bg-gray-50 border-2 border-transparent rounded-[1.8rem] focus:bg-white focus:border-[#006064]/20 focus:ring-0 font-bold text-[#006064] placeholder:text-gray-300 transition-all shadow-inner" 
                                   placeholder="Email Admin">
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[9px] font-black text-red-500 uppercase italic ml-2" />
                        </div>

                        <div class="space-y-3 group">
                            <label class="font-black text-[#006064] uppercase text-[10px] tracking-[0.2em] ml-2 block opacity-50 group-focus-within:opacity-100 transition-opacity">Secret Key</label>
                            <input type="password" name="password" required autocomplete="current-password"
                                   class="w-full p-5 bg-gray-50 border-2 border-transparent rounded-[1.8rem] focus:bg-white focus:border-[#006064]/20 focus:ring-0 font-bold text-[#006064] placeholder:text-gray-300 transition-all shadow-inner"
                                   placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[9px] font-black text-red-500 uppercase italic ml-2" />
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-[#006064] text-white font-black py-6 rounded-[2rem] text-sm transition-all duration-500 transform hover:-translate-y-2 active:scale-95 shadow-2xl shadow-teal-900/40 uppercase tracking-[0.2em] hover:bg-teal-900 flex items-center justify-center gap-4 group">
                                <span>Masuk Dashboard</span>
                                <svg class="w-6 h-6 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- FOOTER KECIL (MOBILE) --}}
            <div class="mt-12 text-center lg:hidden">
                <p class="text-[8px] font-black text-white/30 uppercase tracking-[0.6em]">Authorized Personnel Only</p>
            </div>
        </div>
    </div>

    <style>
        .animate-bounce-slow { animation: bounceCustom 4s infinite; }
        @keyframes bounceCustom { 0%, 100% { transform: translateY(-5%); } 50% { transform: translateY(0); } }
    </style>
</x-guest-layout>