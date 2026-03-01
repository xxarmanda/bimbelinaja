<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#006064] relative overflow-hidden py-10">
        
        <a href="/" class="absolute top-8 right-8 flex items-center space-x-2 text-white/50 hover:text-white transition-all font-black text-[10px] uppercase tracking-[0.2em] group z-50 bg-white/10 py-3 px-6 rounded-2xl backdrop-blur-sm border border-white/10 shadow-xl">
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Kembali ke Beranda</span>
        </a>

        <div class="absolute -top-24 -left-24 w-96 h-96 bg-white/5 rounded-full"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-[#FFC107]/10 rounded-full"></div>

        <div class="mb-8 text-center relative z-10">
            <a href="/">
                <div class="bg-white p-4 rounded-[2rem] shadow-2xl inline-block mb-3 transform hover:scale-110 transition duration-500 shadow-black/20">
                    <svg class="w-10 h-10 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
            </a>
            <h2 class="text-3xl font-black text-white uppercase tracking-tighter italic">Daftar Akun <span class="text-[#FFC107]">Baru</span></h2>
            <p class="text-teal-100/60 font-bold text-[10px] uppercase tracking-[0.4em] mt-2 italic">Professional Tutoring System</p>
        </div>

        <div class="w-full sm:max-w-md px-10 py-10 bg-white shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] border-t-[12px] border-[#FFC107] sm:rounded-[3.5rem] relative z-10">
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="font-black text-[#006064] uppercase text-[10px] tracking-widest ml-1">Nama Lengkap</label>
                    <input type="text" name="name" :value="old('name')" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-[#FFC107]/20 font-bold text-[#006064]" placeholder="Abdul Fathir Iman">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div>
                    <label class="font-black text-[#006064] uppercase text-[10px] tracking-widest ml-1">Alamat Email</label>
                    <input type="email" name="email" :value="old('email')" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-[#FFC107]/20 font-bold text-[#006064]" placeholder="fathir@bimbelinaja.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label class="font-black text-[#006064] uppercase text-[10px] tracking-widest ml-1">Kata Sandi</label>
                    <input type="password" name="password" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-[#FFC107]/20 font-bold text-[#006064]" placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label class="font-black text-[#006064] uppercase text-[10px] tracking-widest ml-1">Konfirmasi Sandi</label>
                    <input type="password" name="password_confirmation" required class="w-full p-4 bg-gray-50 border-none rounded-2xl focus:ring-4 focus:ring-[#FFC107]/20 font-bold text-[#006064]" placeholder="••••••••">
                </div>

                <div class="pt-4">
                    <button class="w-full bg-[#006064] text-white font-black py-5 rounded-3xl text-sm transition-all duration-300 transform hover:-translate-y-1 shadow-2xl shadow-teal-900/40 uppercase tracking-[0.2em] hover:bg-teal-900">
                        Buat Akun Sekarang
                    </button>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-[10px] font-black text-gray-400 hover:text-[#006064] uppercase tracking-widest transition">
                        Sudah punya akun? <span class="text-[#006064] underline">Masuk di sini</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>