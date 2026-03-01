<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Online - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- 1. KEMBALIKAN: Alpine.js (Sangat penting agar Dropdown Navigasi Berfungsi) --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
    </style>
</head>

{{-- 2. KEMBALIKAN: x-data agar menu 'Layanan' tahu kapan harus terbuka --}}
<body class="bg-white font-sans antialiased text-gray-900" x-data="{ mobileMenuOpen: false, layananOpen: false }">
    
    {{-- Memanggil Navigasi Utama --}}
    @include('layouts.nav')

    {{-- 1. HERO SECTION --}}
    @php $hero = $onlineSettings['hero'] ?? null; @endphp
    <section class="bg-[#006064] py-24 px-6 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-16 relative z-10">
            <div class="reveal active">
                <h1 class="text-4xl md:text-5xl font-black mb-8 leading-tight uppercase italic tracking-tighter">
                    {{ $hero->title ?? 'Les Privat Online & Interaktif' }}
                </h1>
                <p class="text-teal-50 text-lg leading-relaxed mb-10 font-medium">
                    {{ $hero->description ?? '' }}
                </p>
                
                {{-- 3. UPDATE: Penambahan Tombol Daftar --}}
                <div class="flex flex-wrap gap-5">
                    
                    {{-- Tombol Daftar Baru --}}
                    <a href="{{ route('programs.public') }}" 
                       class="bg-[#FFC107] text-[#006064] font-black py-4 px-10 rounded-xl shadow-xl uppercase text-[10px] tracking-widest hover:bg-yellow-500 transition-all active:scale-95 shadow-lg shadow-yellow-500/20">
                        Daftar Les Online 
                    </a>
                </div>
            </div>
            <div class="relative flex justify-center reveal active">
                @if($hero && $hero->image)
                    <img src="{{ asset('storage/' . $hero->image) }}" class="w-full max-w-lg rounded-[3rem] shadow-2xl border-8 border-white/10 rotate-2 transition-transform hover:rotate-0 duration-500">
                @endif
                <div class="absolute -bottom-4 bg-[#FFC107] text-[#006064] font-black px-10 py-3 rounded-full shadow-lg transform rotate-2 italic uppercase text-xs">Privat Online</div>
            </div>
        </div>
    </section>

    {{-- 2. TIGA FITUR UTAMA --}}
    <section class="py-24 px-6 max-w-7xl mx-auto grid md:grid-cols-3 gap-10">
        @foreach(['feature_1', 'feature_2', 'feature_3'] as $sec)
            @php $f = $onlineSettings[$sec] ?? null; @endphp
            <div class="bg-white p-12 rounded-[2.5rem] shadow-2xl shadow-gray-200 text-center border border-gray-50 reveal hover:scale-105 transition-transform duration-500">
                @if($f && $f->image)
                    <img src="{{ asset('storage/' . $f->image) }}" class="h-20 mx-auto mb-8">
                @endif
                <h3 class="text-xl font-black text-[#006064] mb-6 uppercase italic">{{ $f->title ?? 'Judul Seksi' }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed font-bold uppercase tracking-tight text-gray-400">{{ $f->description ?? '' }}</p>
            </div>
        @endforeach
    </section>

    {{-- 3. QUOTE SECTION --}}
    @php $quote = $onlineSettings['quote'] ?? null; @endphp
    <section class="bg-[#006064] py-24 px-6 text-white border-y-8 border-[#FFC107]">
        <div class="max-w-5xl mx-auto flex gap-12 items-start reveal">
            <span class="text-8xl font-serif text-teal-300 leading-none">“</span>
            <div class="grid md:grid-cols-2 gap-12 italic">
                <h2 class="text-3xl font-black leading-tight uppercase">{{ $quote->title ?? 'Pembelajaran Online' }}</h2>
                <p class="text-teal-100 font-medium leading-relaxed border-l-4 border-[#FFC107] pl-8 font-bold">{{ $quote->description ?? '' }}</p>
            </div>
        </div>
    </section>

    {{-- 4. ICON GRID (BENEFITS) --}}
    <section class="py-24 px-6 max-w-7xl mx-auto bg-[#F8FAFC] rounded-[4rem] my-10 shadow-inner">
        <div class="text-center mb-20">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">Pilihan Privat Online Terbaik</h2>
            <div class="w-20 h-1 bg-[#FFC107] mx-auto mt-4 rounded-full"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-y-20 gap-x-12">
            @foreach(['benefit_1', 'benefit_2', 'benefit_3', 'benefit_4', 'benefit_5', 'benefit_6'] as $sec)
                @php $b = $onlineSettings[$sec] ?? null; @endphp
                <div class="flex flex-col items-center text-center reveal group">
                    <div class="w-16 h-16 bg-[#006064] rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:bg-[#FFC107] transition-all duration-500 group-hover:rotate-12">
                        @if($b && $b->image)
                            <img src="{{ asset('storage/' . $b->image) }}" class="w-8 h-8 filter invert group-hover:invert-0 transition-all">
                        @endif
                    </div>
                    <h4 class="font-black text-[#006064] mb-3 uppercase text-sm italic tracking-widest">{{ $b->title ?? '' }}</h4>
                    <p class="text-gray-400 text-[10px] leading-relaxed px-4 font-bold uppercase tracking-tight">{{ $b->description ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </section>

    @include('layouts.footer')

    <script>
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
        }, { threshold: 0.1 });
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>