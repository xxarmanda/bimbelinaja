<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BimbelinAja - Les Privat Terbaik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .scroll-mt-24 { scroll-margin-top: 6rem; }
        
        .dropdown:hover .dropdown-menu {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
        }

        /* --- 1. ANIMASI MARQUEE TUTOR --- */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 40s linear infinite;
        }

        /* --- 2. WRAPPER DENGAN GRADASI RESPONSIVE --- */
        .marquee-wrapper {
            position: relative;
            overflow: hidden;
            padding: 10px 0; /* Memberi ruang sedikit di atas/bawah */
        }

        /* Base Style untuk Pembatas (Mobile First) */
        .marquee-wrapper::before,
        .marquee-wrapper::after {
            content: "";
            position: absolute;
            top: 0;
            width: 80px; /* Ukuran default untuk Mobile agar kartu tidak tertutup total */
            height: 100%;
            z-index: 10;
            pointer-events: none;
            transition: width 0.3s ease;
        }

        /* Penyesuaian untuk Desktop (Layar Lebar) */
        @media (min-width: 1024px) {
            .marquee-wrapper::before,
            .marquee-wrapper::after {
                width: 250px; /* Ukuran tebal untuk tampilan Desktop */
            }
        }

        /* Sisi Kiri: Putih tebal di pinggir lalu memudar ke tengah */
        .marquee-wrapper::before {
            left: 0;
            background: linear-gradient(to right, 
                rgba(255, 255, 255, 1) 0%, 
                rgba(255, 255, 255, 0.9) 20%, 
                rgba(255, 255, 255, 0) 100%);
        }

        /* Sisi Kanan: Putih tebal di pinggir lalu memudar ke tengah */
        .marquee-wrapper::after {
            right: 0;
            background: linear-gradient(to left, 
                rgba(255, 255, 255, 1) 0%, 
                rgba(255, 255, 255, 0.9) 20%, 
                rgba(255, 255, 255, 0) 100%);
        }

        /* --- 3. REVEAL ANIMATION (OPSIONAL) --- */
        .reveal { 
            opacity: 0; 
            transform: translateY(30px); 
            transition: all 0.8s ease-out; 
        }
        .reveal.active { 
            opacity: 1; 
            transform: translateY(0); 
        }

        [x-cloak] { display: none !important; }

         /* PEMBATAS Radar media marquee style */
        /* Animasi ke Atas */
        @keyframes marquee-up {
        0% { transform: translateY(0); }
        100% { transform: translateY(-50%); }
        }

        /* Animasi ke Bawah */
        @keyframes marquee-down {
            0% { transform: translateY(-50%); }
            100% { transform: translateY(0); }
        }

        .animate-marquee-up {
            animation: marquee-up 25s linear infinite; /* Kecepatan bisa diatur di sini (25s) */
        }

        .animate-marquee-down {
            animation: marquee-down 25s linear infinite;
        }

        /* Hilangkan pointer-events agar kursor tidak mengganggu kelancaran animasi */
        .marquee-column {
            pointer-events: none; 
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">

    @include('layouts.nav')

    {{-- HEADER (SLIDER ALPINE.JS) --}}
    <header class="relative min-h-screen flex items-center overflow-hidden" 
        x-data="{ 
            activeSlide: 1, 
            totalSlides: {{ $sliders->count() > 0 ? $sliders->count() : 1 }},
            next() { this.activeSlide = this.activeSlide === this.totalSlides ? 1 : this.activeSlide + 1 },
            prev() { this.activeSlide = this.activeSlide === 1 ? this.totalSlides : this.activeSlide - 1 }
        }" 
        x-init="if(totalSlides > 1) setInterval(() => { next() }, 5000)">

        <div class="absolute inset-0 z-0 bg-[#006064]">
            @forelse($sliders as $index => $slider)
                <div x-show="activeSlide === {{ $index + 1 }}" 
                    x-transition:enter="transition transform duration-1000 ease-in-out"
                    x-transition:enter-start="translate-x-full"
                    x-transition:enter-end="translate-x-0"
                    x-transition:leave="transition transform duration-1000 ease-in-out"
                    x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="-translate-x-full"
                    class="absolute inset-0 w-full h-full">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#006064]/95 via-[#006064]/70 to-transparent"></div>
                </div>
            @empty
                <div class="w-full h-full bg-[#006064]"></div>
            @endforelse
        </div>

        <div class="container mx-auto px-10 relative z-10 pt-32 pb-20">
            <div class="max-w-3xl">
                <p class="text-lg font-black mb-6 text-[#FFC107] uppercase tracking-[0.4em] animate-bounce">
                    {{ $settings['hero_label'] ?? 'Les Privat Terbaik' }}
                </p>
                <h1 class="text-5xl md:text-8xl font-black text-white leading-[0.85] mb-10 uppercase tracking-tighter italic">
                    {!! $settings['hero_title'] ?? 'DIPERCAYA <br> <span class="text-[#FFC107]">1.000+</span> <br> SISWA' !!}
                </h1>
                <p class="text-xl mb-12 text-white/80 leading-relaxed max-w-xl font-medium italic">
                    "{{ $settings['hero_desc'] ?? 'BimbelinAja menyediakan tutor terseleksi dari universitas ternama untuk membantumu meraih prestasi terbaik.' }}"
                </p>
                <div class="flex flex-col sm:flex-row gap-6">
                    <a href="#program-les" class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 px-12 rounded-[2.5rem] transition-all hover:scale-105 shadow-2xl shadow-yellow-500/40 inline-flex items-center group uppercase tracking-widest text-xs">Pilih Program</a>
                </div>
            </div>
        </div>
    </header>

    {{-- PROGRAM LES --}}
    <section id="program-les" class="py-24 bg-[#E0F2F1] scroll-mt-24">
        <div class="container mx-auto px-10 text-center">
            <h2 class="text-4xl font-black text-[#006064] mb-4 uppercase tracking-tighter">Pilih Program Les Privat</h2>
            <div class="w-32 h-2 bg-[#FFC107] mx-auto rounded-full mb-16"></div>
            <div class="flex flex-wrap justify-center gap-6">
                @forelse($programs as $program)
                    <a href="{{ route('programs.show', $program->id) }}" 
                       class="group relative bg-[#006064] rounded-[2rem] p-8 w-full sm:w-64 md:w-52 lg:w-48 h-52 flex flex-col items-center justify-center text-center transition-all duration-500 hover:bg-teal-900 hover:-translate-y-3 shadow-xl overflow-hidden border-b-8 border-[#FFC107]/30">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-white/5 rounded-full transition-transform group-hover:scale-150"></div>
                        <div class="relative z-10 flex flex-col items-center">
                            <div class="w-16 h-16 mb-4 bg-white rounded-2xl flex items-center justify-center p-3 shadow-lg group-hover:rotate-12 transition-transform">
                                @if($program->icon)
                                    <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->name }}" class="w-full h-full object-contain">
                                @else
                                    <span class="text-2xl">📚</span>
                                @endif
                            </div>
                            <h3 class="text-white font-black text-[10px] md:text-xs uppercase tracking-[0.2em] leading-tight">{{ $program->name }}</h3>
                        </div>
                    </a>
                @empty
                    <div class="w-full text-center py-20 bg-white rounded-[3rem]">
                        <p class="text-gray-400 font-black uppercase tracking-widest italic">Belum ada program tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TENTANG --}}
<section id="tentang" class="py-32 bg-white scroll-mt-24 overflow-hidden reveal">
    <div class="container mx-auto px-10">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            {{-- SISI KIRI: TEKS & STATISTIK --}}
            <div class="relative z-10">
                <div class="inline-block px-4 py-2 bg-teal-50 text-[#006064] rounded-lg mb-6 text-[10px] font-black uppercase tracking-[0.3em]">
                    {{ $settings['about_label'] ?? 'KENALI BIMBELINAJA LEBIH DEKAT' }}
                </div>
                <h2 class="text-4xl md:text-6xl font-black text-[#006064] uppercase tracking-tighter mb-8 italic leading-[0.9]">
                    {!! $settings['about_title'] ?? 'TENTANG <br><span class="text-[#FFC107]">BIMBELINAJA</span>' !!}
                </h2>
                <div class="space-y-6 text-gray-500 font-medium leading-relaxed italic text-lg">
                    <p>{{ $settings['about_desc_1'] ?? 'Kami adalah platform bimbingan belajar yang berfokus pada kualitas pengajaran.' }}</p>
                    <p>{{ $settings['about_desc_2'] ?? '' }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-8 mt-12">
                    <div class="p-8 bg-white border border-gray-100 rounded-[2.5rem] shadow-xl shadow-teal-900/5 text-center">
                        <h5 class="text-4xl font-black text-[#006064] italic mb-1"><span class="counter" data-target="100">0</span>+</h5>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Tutor Terseleksi</p>
                    </div>
                    <div class="p-8 bg-white border border-gray-100 rounded-[2.5rem] shadow-xl shadow-yellow-500/5 text-center">
                        <h5 class="text-4xl font-black text-[#006064] italic mb-1"><span class="counter" data-target="98">0</span>%</h5>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kepuasan Siswa</p>
                    </div>
                </div>
            </div>

            {{-- SISI KANAN: VIDEO & TOMBOL KONSULTASI --}}
            <div class="relative flex flex-col items-center lg:items-end">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-[#E0F2F1] rounded-full -z-10 animate-pulse"></div>
                
                @if(isset($settings['youtube_video_id']))
                    <div class="relative p-4 bg-white shadow-2xl rounded-[4rem] border border-gray-100 transform rotate-2 hover:rotate-0 transition-transform duration-500 w-full">
                        <div class="aspect-video rounded-[3rem] overflow-hidden bg-gray-900 shadow-inner">
                            <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $settings['youtube_video_id'] }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="absolute -bottom-6 -right-6 bg-[#006064] p-8 rounded-[2.5rem] shadow-xl text-white text-center">
                            <div class="bg-[#FFC107] p-2 rounded-xl mb-3 inline-block">
                                <svg class="w-6 h-6 text-[#006064]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L1 12h3v9h6v-6h4v6h6v-9h3L12 2z"/></svg>
                            </div>
                            <p class="text-[9px] font-black uppercase tracking-widest leading-none">Official<br>Presentation</p>
                        </div>
                    </div>

                    {{-- TOMBOL KONSULTASI DI BAWAH VIDEO --}}
                    <div class="mt-16 w-full flex justify-center lg:justify-end">
                        <a href="https://wa.me/6283102064517" target="_blank" 
                           class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 px-12 rounded-[2.5rem] transition-all hover:scale-105 shadow-2xl shadow-yellow-500/40 inline-flex items-center group uppercase tracking-widest text-xs">
                            <span>Konsultasi Gratis Sekarang</span>
                            <svg class="w-5 h-5 ml-4 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

    {{-- CARA DAFTAR --}}
    <section id="cara-daftar" class="py-24 bg-gray-50 scroll-mt-24">
        <div class="container mx-auto px-10">
            <div class="text-center mb-20 reveal">
                <h2 class="text-4xl md:text-6xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                    {{ $settings['registration_title'] ?? 'CARA DAFTAR LES PRIVAT' }} 
                    <span class="text-[#FFC107]">{{ $settings['registration_brand'] ?? 'BIMBELINAJA' }}</span>
                </h2>
                <p class="text-gray-500 font-medium italic mt-6 max-w-2xl mx-auto text-sm md:text-base leading-relaxed">
                    {{ $settings['registration_subtitle'] ?? 'Dapatkan tutor profesional sesuai kebutuhanmu.' }}
                </p>
                <div class="w-24 h-2 bg-[#FFC107] mx-auto mt-8 rounded-full shadow-sm"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mt-16">
                @forelse($registrationSteps as $index => $step)
                    <div class="bg-white p-10 rounded-[3rem] shadow-xl shadow-teal-900/5 relative group reveal border border-gray-100 transition-all hover:-translate-y-2">
                        <div class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center mb-8 group-hover:bg-[#FFC107] transition-all duration-500 transform group-hover:-rotate-12 absolute -top-10 left-1/2 -translate-x-1/2 border-4 border-gray-50 shadow-xl overflow-hidden p-2">
                            @if($step->icon)
                                <img src="{{ asset('storage/' . $step->icon) }}" alt="{{ $step->title }}" class="w-full h-full object-cover rounded-xl">
                            @else
                                <span class="text-2xl">📝</span>
                            @endif
                        </div>
                        <div class="mt-8 text-center">
                            <h4 class="text-xl font-black text-[#006064] uppercase tracking-tighter mb-4 italic">{{ $step->title }}</h4>
                            <p class="text-gray-400 text-xs leading-relaxed font-bold italic">"{{ $step->description }}"</p>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-10 text-center opacity-30">
                        <p class="font-black uppercase tracking-widest text-xs italic">Belum ada langkah pendaftaran.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- SEKSI TUTOR MARQUEE - SIGNATURE SYSTEM --}}
<section id="tutor-home" class="py-32 bg-white scroll-mt-24 overflow-hidden reveal">
    <div class="container mx-auto px-10">
        
        {{-- HEADER SECTION: Flex Split (Judul & Deskripsi) --}}
        <div class="flex flex-col lg:flex-row items-end justify-between gap-12 mb-20">
            {{-- Kiri: Judul & Label --}}
            <div class="w-full lg:w-2/3 space-y-4">
                <p class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.4em] mb-4 italic flex items-center">
                    <span class="w-10 h-[2px] bg-[#006064] mr-3"></span>
                    {{ $settings['tutor_label'] ?? 'Tutor Terseleksi' }}
                </p>
                <h2 class="text-5xl md:text-6xl font-black text-[#006064] uppercase italic tracking-tighter leading-[0.85]">
                    {!! $settings['tutor_title'] ?? 'Tutor Les <span class="text-[#FFC107]">Privat</span> Terseleksi' !!}
                </h2>
            </div>

            {{-- Kanan: DESKRIPSI (Muncul di Sini) --}}
            <div class="w-full lg:w-1/3">
                 <p class="text-gray-500 font-bold italic text-sm leading-relaxed border-l-4 border-[#FFC107] pl-6 py-2">
                    {{ $settings['tutor_description'] ?? 'Tutor terseleksi dari Universitas Ternama siap menjadi partner belajar dan pengembangan dirimu.' }}
                 </p>
            </div>
        </div>
    </div>

    {{-- MARQUEE WRAPPER --}}
    <div class="marquee-wrapper pt-4 pb-16">
        <div class="animate-marquee flex items-center space-x-12">
            {{-- Loop Pertama --}}
            @foreach($tutors as $tutor)
            <div class="w-[280px] flex-shrink-0 group">
                <div class="bg-white rounded-[3rem] p-5 shadow-xl shadow-teal-900/5 border border-gray-50 transition-all duration-700 group-hover:-translate-y-6 group-hover:shadow-2xl group-hover:shadow-teal-900/10 group-hover:border-[#FFC107]/50 relative">
                    
                    {{-- Badge Status Kecil --}}
                    <div class="absolute top-8 right-8 z-10 bg-[#FFC107] text-[#006064] text-[8px] font-black px-3 py-1 rounded-full uppercase italic opacity-0 group-hover:opacity-100 transition-opacity">Verified Tutor</div>

                    <div class="relative aspect-[4/5] rounded-[2.5rem] overflow-hidden mb-6 bg-gray-50">
                        @if($tutor->photo)
                            <img src="{{ asset('storage/' . $tutor->photo) }}" 
                                 class="w-full h-full object-cover transition-all duration-1000 scale-100 group-hover:scale-110" 
                                 alt="{{ $tutor->name }}">
                        @else
                            <div class="w-full h-full bg-[#006064] flex items-center justify-center text-white font-black text-4xl italic">{{ substr($tutor->name, 0, 1) }}</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#006064]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    <div class="text-center pb-4">
                        <h4 class="font-black text-[#006064] uppercase tracking-tighter text-base italic mb-2 leading-none">{{ $tutor->name }}</h4>
                        <p class="text-teal-600 font-bold uppercase tracking-widest text-[9px] italic bg-teal-50 inline-block px-4 py-1 rounded-full">{{ $tutor->role }}</p>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Loop Kedua (Duplicate untuk Marquee Smooth) --}}
            @foreach($tutors as $tutor)
            <div class="w-[280px] flex-shrink-0 group">
                <div class="bg-white rounded-[3rem] p-5 shadow-xl shadow-teal-900/5 border border-gray-50 transition-all duration-700 group-hover:-translate-y-6 group-hover:shadow-2xl group-hover:shadow-teal-900/10 group-hover:border-[#FFC107]/50 relative">
                    <div class="absolute top-8 right-8 z-10 bg-[#FFC107] text-[#006064] text-[8px] font-black px-3 py-1 rounded-full uppercase italic opacity-0 group-hover:opacity-100 transition-opacity">Verified Tutor</div>

                    <div class="relative aspect-[4/5] rounded-[2.5rem] overflow-hidden mb-6 bg-gray-50">
                        @if($tutor->photo)
                            <img src="{{ asset('storage/' . $tutor->photo) }}" 
                                 class="w-full h-full object-cover transition-all duration-1000 scale-100 group-hover:scale-110" 
                                 alt="{{ $tutor->name }}">
                        @else
                            <div class="w-full h-full bg-[#006064] flex items-center justify-center text-white font-black text-4xl italic">{{ substr($tutor->name, 0, 1) }}</div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-[#006064]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    </div>

                    <div class="text-center pb-4">
                        <h4 class="font-black text-[#006064] uppercase tracking-tighter text-base italic mb-2 leading-none">{{ $tutor->name }}</h4>
                        <p class="text-teal-600 font-bold uppercase tracking-widest text-[9px] italic bg-teal-50 inline-block px-4 py-1 rounded-full">{{ $tutor->role }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

   <section class="py-24 bg-white overflow-hidden">
    <div class="container mx-auto px-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-3/5 grid grid-cols-1 md:grid-cols-2 gap-6 order-2 lg:order-1">
                @forelse($serviceAreas as $area)
                    <div class="bg-white p-8 rounded-[3rem] shadow-sm border border-gray-100 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group relative">
                        {{-- Ikon Bulat Kecil --}}
                        <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center text-[#006064] group-hover:bg-[#FFC107] group-hover:text-[#006064] transition-all duration-500 mb-6">
                            @if($area->icon)
                                <img src="{{ asset('storage/' . $area->icon) }}" class="w-6 h-6 object-contain">
                            @else
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                            @endif
                        </div>
                        
                        <h3 class="font-black text-[#006064] text-lg uppercase italic leading-tight mb-3 tracking-tighter">{{ $area->city_name }}</h3>
                        <p class="text-[11px] text-gray-400 leading-relaxed italic font-medium uppercase tracking-wider">{{ $area->description }}</p>
                        
                        {{-- Aksen Dekoratif --}}
                        <div class="absolute top-6 right-6 opacity-5 group-hover:opacity-20 transition-opacity">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/></svg>
                        </div>
                    </div>
                @empty
                    {{-- Tampilan jika data kosong (Empty State) --}}
                    <div class="col-span-2 py-20 bg-gray-50 rounded-[4rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
                        <p class="text-gray-400 font-black uppercase text-[10px] tracking-widest italic">Data area layanan belum tersedia.</p>
                    </div>
                @endforelse
            </div>

            <div class="w-full lg:w-2/5 order-1 lg:order-2 text-left space-y-6">
                <div class="space-y-2">
                    <h4 class="text-[#006064] font-black uppercase text-[10px] tracking-[0.4em] italic mb-4 flex items-center">
                        <span class="w-10 h-[2px] bg-[#FFC107] mr-3"></span> Area Layanan
                    </h4>
                    <h2 class="text-5xl lg:text-6xl font-black text-[#006064] uppercase tracking-tighter italic leading-[0.9] lg:leading-[0.85]">
                        Area Layanan <br>Les Privat di <br><span class="text-[#FFC107] drop-shadow-sm">Ciayu<br>majakuning</span>
                    </h2>
                </div>
                
                <div class="pt-4">
                    <p class="text-gray-500 font-bold italic text-sm leading-relaxed border-l-4 border-[#FFC107] pl-6 py-2">
                        Tutor kami siap datang ke rumah Anda di wilayah <span class="text-[#006064]">Cirebon, Indramayu, Majalengka, dan Kuningan</span>. Kami menjangkau pelosok desa hingga pusat kota.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

    {{-- SECTION TESTIMONI --}}
    <section class="bg-[#006064] py-32 px-6 overflow-hidden">
        <div class="max-w-6xl mx-auto">
            <div class="mb-20 text-center reveal">
                <h2 class="text-3xl md:text-5xl font-black text-white uppercase italic tracking-tighter mb-4">Testimoni Siswa</h2>
                <p class="text-teal-100/60 font-bold text-xs uppercase tracking-[0.4em]">Apa Kata Mereka Tentang BimbelinAja</p>
                <div class="w-24 h-2 bg-[#FFC107] mx-auto mt-6 rounded-full shadow-sm"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($testimonials as $testi)
                <div class="relative bg-white rounded-[3rem] overflow-hidden shadow-2xl flex flex-col group transition-all duration-500 hover:-translate-y-4 hover:shadow-yellow-500/30 reveal">
                    <div class="relative aspect-video overflow-hidden bg-gray-100">
                        @if($testi->image)
                            <img src="{{ asset('storage/' . $testi->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="Testimoni {{ $testi->name }}">
                        @else
                            <div class="w-full h-full bg-teal-800 flex items-center justify-center"><svg class="w-20 h-20 text-teal-700" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg></div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    <div class="relative p-10 pt-12 flex flex-col flex-grow bg-white">
                        <div class="absolute left-10 -top-7 z-10">
                            <div class="bg-[#006064] w-14 h-14 rounded-2xl flex items-center justify-center shadow-xl border-4 border-white transform group-hover:rotate-12 transition-transform">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H14.017C13.4647 8 13.017 8.44772 13.017 9V15C13.017 15.3086 13.1311 15.6046 13.3379 15.832L14.017 21ZM4.017 21L4.017 18C4.017 16.8954 4.91243 16 6.017 16H9.017C9.56928 16 10.017 15.5523 10.017 15V9C10.017 8.44772 9.56928 8 9.017 8H4.017C3.46472 8 3.017 8.44772 3.017 9V15C3.017 15.3086 3.13109 15.6046 3.33789 15.832L4.017 21Z"/></svg>
                            </div>
                        </div>
                        <p class="text-gray-500 italic font-medium leading-relaxed mb-10 text-sm md:text-base">"{{ $testi->message }}"</p>
                        <div class="mt-auto border-t border-gray-100 pt-6">
                            <h4 class="font-black text-[#006064] text-base uppercase tracking-tighter leading-none mb-1">{{ $testi->name }}</h4>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">{{ $testi->title }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 text-center opacity-30"><p class="text-white italic uppercase font-black text-xs tracking-[0.5em]">Belum Ada Testimoni</p></div>
                @endforelse
            </div>
        </div>
    </section>

            {{-- MEDIA PATNER CONVERGE --}}
          <section class="py-24 bg-white border-t border-gray-50 overflow-hidden">
        <div class="container mx-auto px-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            {{-- KIRI: TEKS JUDUL --}}
            <div class="w-full lg:w-1/3 text-left">
                <div class="space-y-2">
                    <h4 class="text-[#006064] font-black uppercase text-[10px] tracking-[0.4em] italic mb-4 flex items-center">
                        <span class="w-10 h-[2px] bg-[#FFC107] mr-3"></span> Media Coverage
                    </h4>
                    <h2 class="text-5xl lg:text-6xl font-black text-[#006064] uppercase tracking-tighter italic leading-[0.9] lg:leading-[0.85] mb-6">
                        Liputan <br><span class="text-[#FFC107]">Media</span> <br>Nasional
                    </h2>
                </div>
                <p class="text-gray-500 font-bold italic text-sm leading-relaxed border-l-4 border-[#FFC107] pl-6 py-2">
                    Kepercayaan media nasional adalah bukti nyata dedikasi BimbelinAja dalam mencerdaskan bangsa.
                </p>
            </div>

            {{-- KANAN: ANIMASI MARQUEE JALAN TERUS --}}
            <div class="w-full lg:w-2/3 flex gap-8 h-[500px] relative">
                {{-- Efek Blur Transparan di Atas & Bawah agar logo muncul/hilang dengan halus --}}
                <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-white via-white/80 to-transparent z-10"></div>
                <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-white via-white/80 to-transparent z-10"></div>

                {{-- KOLOM 1: NAIK KE ATAS --}}
                <div class="flex-1 overflow-hidden relative bg-gray-50 rounded-[4rem] border border-gray-100 marquee-column">
                    <div class="flex flex-col gap-16 py-12 animate-marquee-up">
                        @foreach($mediaCoverages as $media)
                            <div class="flex justify-center items-center px-8">
                                <img src="{{ asset('storage/'.$media->logo) }}" alt="{{ $media->name }}" class="h-16 md:h-20 w-auto object-contain transition-all filter drop-shadow-sm">
                            </div>
                        @endforeach
                        {{-- Duplikasi data agar animasi tidak terputus --}}
                        @foreach($mediaCoverages as $media)
                            <div class="flex justify-center items-center px-8">
                                <img src="{{ asset('storage/'.$media->logo) }}" alt="{{ $media->name }}" class="h-16 md:h-20 w-auto object-contain transition-all filter drop-shadow-sm">
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- KOLOM 2: TURUN KE BAWAH --}}
                <div class="flex-1 overflow-hidden relative bg-gray-50 rounded-[4rem] border border-gray-100 marquee-column">
                    <div class="flex flex-col gap-16 py-12 animate-marquee-down">
                        @foreach($mediaCoverages as $media)
                            <div class="flex justify-center items-center px-8">
                                <img src="{{ asset('storage/'.$media->logo) }}" alt="{{ $media->name }}" class="h-16 md:h-20 w-auto object-contain transition-all filter drop-shadow-sm">
                            </div>
                        @endforeach
                        @foreach($mediaCoverages as $media)
                            <div class="flex justify-center items-center px-8">
                                <img src="{{ asset('storage/'.$media->logo) }}" alt="{{ $media->name }}" class="h-16 md:h-20 w-auto object-contain transition-all filter drop-shadow-sm">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

    {{-- KONTAK WHATSAPP --}}
    <section id="kontak" class="py-24 bg-[#E0F2F1] scroll-mt-24">
        <div class="container mx-auto px-10">
            <div class="bg-[#006064] py-16 px-8 rounded-[3rem] text-center shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <h2 class="text-white text-2xl md:text-4xl font-black uppercase tracking-tighter leading-tight mb-8">
                        Belum menemukan program yang anda cari?<br> 
                        <span class="text-teal-200">hubungi kami via Whatsapp.</span>
                    </h2>
                    <a href="https://wa.me/6283102064517" target="_blank" 
                       class="inline-flex items-center justify-center bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black px-10 py-5 rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-xl uppercase tracking-widest text-xs">
                        Whatsapp Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
    
    {{-- SCRIPTS --}}
    <script>
        const startCounters = () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                counter.innerText = '0';
                const target = +counter.getAttribute('data-target');
                const speed = 100; 
                const increment = target / speed;

                const updateCount = () => {
                    const count = +counter.innerText;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        };

        const observerOptions = { threshold: 0.25 }; 
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    if (entry.target.id === 'tentang') {
                        startCounters();
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>