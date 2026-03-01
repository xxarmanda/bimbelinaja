<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Les - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up { animation: fadeUp 0.8s ease-out forwards; }
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.9s cubic-bezier(0.17, 0.55, 0.55, 1);
        }
        .reveal.active { opacity: 1; transform: translateY(0); }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-[#E0F2F1] overflow-x-hidden">

    @include('layouts.nav')

    {{-- HEADER --}}
    <header class="bg-[#004D40] py-16 flex flex-col items-center justify-center text-center border-b-4 border-[#FFC107] animate-fade-up">
        <div class="mb-4 text-[#FFC107] animate-bounce">
            <svg class="w-14 h-14" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 3L1 9l11 6l9-4.91V17h2V9M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82z"/>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-widest uppercase italic leading-none">Katalog <span class="text-[#FFC107]">Program</span></h1>
    </header>

    {{-- MAIN CONTENT --}}
    <main class="py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="mb-14 text-center reveal">
                <h2 class="text-3xl md:text-4xl font-black text-[#006064] tracking-tight uppercase italic">Hai, Sobat Bimbel!</h2>
                <p class="text-gray-500 italic mt-1 uppercase tracking-widest text-[10px] md:text-xs">Mau belajar apa hari ini?</p>
            </div>

            <div class="flex flex-wrap justify-center gap-8">
                @forelse($programs as $index => $program)
                    {{-- LANGKAH SAKTI: Normalisasi Jalur Gambar --}}
                    @php 
                        // Mengambil nama file murni (contoh: program_177...png)
                        $fileName = basename($program->icon);
                        
                        // Memaksa sistem mencari di folder public/uploads/programs/
                        $cleanPath = 'uploads/programs/' . $fileName;
                    @endphp

                    <div class="reveal">
                        <a href="{{ route('programs.show', $program->id) }}" 
                           class="group relative bg-[#006064] rounded-[2.5rem] p-8 w-full sm:w-64 md:w-52 lg:w-48 h-60 flex flex-col items-center justify-center text-center 
                                  transition-all duration-500 hover:bg-[#004D40] hover:-translate-y-3 active:scale-95 shadow-xl overflow-hidden border border-white/10">
                            
                            <div class="absolute inset-0 opacity-10 pointer-events-none group-hover:scale-110 transition-transform duration-700">
                                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                                    <path d="M0 100 C 20 20 50 20 100 100 Z" fill="white"></path>
                                </svg>
                            </div>

                            {{-- AREA IKON/GAMBAR --}}
                            <div class="relative z-10 w-20 h-20 mb-6 bg-white rounded-[1.8rem] flex items-center justify-center p-4 shadow-2xl transition-all duration-500 group-hover:rotate-6">
                                @php
                                    $icon = $program->icon ?? null;
                                @endphp

                                @if(!empty($icon) && file_exists(public_path($icon)))
                                    <img src="{{ asset($icon) }}" 
                                        alt="{{ $program->name }}" 
                                        class="w-full h-full object-contain transition-transform group-hover:scale-110 duration-500">
                                @else
                                    <span class="text-3xl text-[#006064]">📚</span>
                                @endif
                            </div>

                            <h3 class="relative z-10 text-white font-black text-xs md:text-sm uppercase tracking-widest leading-tight">
                                {{ $program->name }}
                            </h3>
                        </a>
                    </div>
                @empty
                    <div class="w-full py-20 bg-white/50 rounded-3xl border-2 border-dashed border-[#006064]/20 text-center animate-pulse">
                        <p class="text-gray-400 font-bold italic uppercase tracking-widest">Belum ada kategori program tersedia di database.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <script>
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('main .reveal, header.animate-fade-up').forEach(el => revealObserver.observe(el));
    </script>
</body>
</html>