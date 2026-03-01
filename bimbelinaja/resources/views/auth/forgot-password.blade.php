<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#006064]">
        
        <div class="mb-8 text-center">
            <a href="/">
                <div class="bg-white p-3 rounded-2xl shadow-xl inline-block mb-4">
                    <svg class="w-12 h-12 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
            </a>
            <h2 class="text-3xl font-extrabold text-white uppercase tracking-tighter">Bimbelin<span class="text-yellow-400">Aja</span></h2>
            <p class="text-teal-100 opacity-80 mt-2">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-3xl border-t-8 border-yellow-400">
            
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email" class="block font-bold text-gray-700 mb-2">Alamat Email</label>
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#006064] focus:ring-[#006064] rounded-xl shadow-sm" 
                                 type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block font-bold text-gray-700">Password</label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-teal-600 hover:text-teal-800 font-medium" href="{{ route('password.request') }}">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#006064] focus:ring-[#006064] rounded-xl shadow-sm"
                                 type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#006064] shadow-sm focus:ring-[#006064]" name="remember">
                        <span class="ms-2 text-sm text-gray-600">Ingat saya di perangkat ini</span>
                    </label>
                </div>

                <div class="mt-8">
                    <x-primary-button class="w-full justify-center bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-4 rounded-xl text-lg transition transform hover:scale-[1.02] active:scale-95 shadow-lg border-none">
                        {{ __('MASUK SEKARANG') }}
                    </x-primary-button>
                </div>

                <div class="mt-6 text-center">
                    <p class="text-sm text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-teal-600 font-bold hover:underline">Daftar di sini</a>
                    </p>
                </div>
            </form>
        </div>
        
        <div class="mt-8">
            <a href="/" class="text-white/60 hover:text-white transition flex items-center space-x-2 text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</x-guest-layout>