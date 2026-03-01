<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Terkirim - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Wajib untuk menu mobile --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }

        /* Animasi Custom Tetap Dipertahankan */
        .animate-slide-up {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-bounce-slow {
            animation: bounceCustom 3s infinite;
        }

        @keyframes bounceCustom {
            0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
            50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
        }
    </style>
</head>
<body class="bg-[#F8FAFC] font-sans antialiased text-[#006064]">

    @include('layouts.nav')

    {{-- KONTEN UTAMA --}}
    <div class="py-12 md:py-20 bg-gray-50 min-h-screen flex items-center justify-center px-6">
        <div class="bg-white p-12 md:p-20 rounded-[4rem] shadow-2xl shadow-teal-900/5 max-w-2xl w-full text-center relative overflow-hidden border border-gray-100">
            
            {{-- Garis Dekoratif Premium --}}
            <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-teal-500 via-yellow-400 to-[#006064]"></div>

            {{-- Icon Centang Hijau dengan Animasi Bounce Pelan --}}
            <div class="w-24 h-24 bg-green-50 rounded-[2.5rem] flex items-center justify-center mx-auto mb-10 border-4 border-white shadow-lg animate-bounce-slow">
                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-4xl md:text-5xl font-black text-[#006064] uppercase italic tracking-tighter mb-6 leading-none">
                BUKTI TERKIRIM! 
            </h1>

            <p class="text-gray-500 font-medium italic text-lg leading-relaxed mb-10 px-4">
                Terima kasih, **{{ $transaction->guest_name }}**! Bukti pembayaran kamu sudah kami terima. 
                Admin akan segera melakukan verifikasi. Mohon tunggu maksimal 1x24 jam ya.
            </p>

            {{-- GRUP TOMBOL AKSI DENGAN ANIMASI MELUNCUR --}}
            <div class="space-y-4 animate-slide-up">
                {{-- TOMBOL UTAMA: DOWNLOAD INVOICE --}}
                <a href="{{ route('invoice.download', $transaction->id) }}" 
                   class="flex items-center justify-center gap-4 w-full bg-[#006064] hover:bg-teal-900 text-white font-black py-6 rounded-[2.5rem] shadow-2xl shadow-teal-900/30 transition-all active:scale-95 group">
                    <svg class="w-6 h-6 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                    </svg>
                    <span class="uppercase tracking-[0.2em] text-xs italic">Simpan Invoice Resmi (PDF)</span>
                </a>

                {{-- TOMBOL KEDUA: KEMBALI --}}
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center gap-2 text-gray-400 font-black text-[10px] uppercase tracking-widest hover:text-[#006064] transition-colors mt-6 italic group">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>

            <div class="pt-10 border-t border-gray-50 mt-10">
                <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.4em]">
                    BimbelinAja Signature System
                </p>
            </div>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>