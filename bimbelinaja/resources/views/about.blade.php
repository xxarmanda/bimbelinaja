<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - BimbelinAja Signature</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 overflow-x-hidden">

    @include('layouts.nav')

    {{-- HEADER --}}
    <header class="bg-[#004D40] py-24 flex flex-col items-center justify-center text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle,white_1px,transparent_1px)] bg-[length:20px_20px]"></div>
        <div class="relative z-10 reveal active">
            <h1 class="text-4xl md:text-7xl font-black text-white tracking-widest uppercase italic leading-none">Profil <span class="text-[#FFC107]">Kami</span></h1>
            <p class="text-teal-200 text-[10px] md:text-xs font-bold uppercase tracking-[0.5em] mt-6 bg-white/5 py-2 px-6 rounded-full inline-block">Membangun Generasi Cerdas & Berkarakter</p>
        </div>
    </header>

    <main class="py-24">
        <div class="container mx-auto px-6 md:px-10">
            <div class="grid lg:grid-cols-2 gap-20 items-start">
                
                {{-- SISI KIRI: DESKRIPSI DETAIL --}}
                <div class="space-y-12">
                    <section class="reveal">
                        <div class="inline-block px-4 py-2 bg-teal-50 text-[#006064] rounded-lg mb-6 text-[10px] font-black uppercase tracking-[0.3em] border border-[#006064]/5">
                            {{ $settings['about_label'] ?? 'SIAPA KAMI?' }}
                        </div>

                        <h2 class="text-3xl md:text-5xl font-black text-[#006064] uppercase tracking-tighter mb-8 italic leading-[0.9]">
                            {!! $settings['about_title'] ?? 'MENGENAL LEBIH DEKAT <br><span class="text-[#FFC107]">TENTANG BIMBELINAJA</span>' !!}
                        </h2>

                        <div class="text-gray-500 font-medium leading-relaxed italic space-y-6 text-base md:text-lg">
                            <p>{{ $settings['about_desc_1'] ?? 'BimbelinAja hadir sebagai solusi revolusioner dalam dunia pendidikan privat.' }}</p>
                            <p>{{ $settings['about_desc_2'] ?? '' }}</p>
                        </div>
                    </section>

                    <section class="p-10 bg-[#006064] rounded-[3rem] text-white shadow-2xl relative overflow-hidden group reveal">
                        <div class="absolute top-0 right-0 p-10 opacity-10 group-hover:scale-110 transition-transform duration-700">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                        </div>
                        <h3 class="text-[#FFC107] text-[10px] font-black uppercase tracking-[0.4em] mb-4 italic">Visi Kami</h3>
                        <p class="text-xl md:text-2xl font-black italic leading-tight">
                            "{{ $settings['vision_text'] ?? 'Menjadi platform pendidikan privat nomor satu.' }}"
                        </p>
                    </section>

                    <section class="reveal">
                        <h3 class="text-[#006064] text-xs font-black uppercase tracking-[0.4em] mb-8 flex items-center italic">
                            <span class="w-10 h-1 bg-[#FFC107] mr-4 rounded-full"></span> Misi Strategis
                        </h3>
                        <ul class="space-y-6">
                            @forelse($missions as $m)
                                <li class="flex items-start group">
                                    <div class="bg-[#FFC107] p-3 rounded-2xl mr-5 group-hover:rotate-12 transition-transform shadow-lg shadow-yellow-400/20">
                                        <svg class="w-5 h-5 text-[#006064]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div>
                                        <h4 class="font-black text-[#006064] uppercase text-xs tracking-widest mb-1 italic">{{ $m->title }}</h4>
                                        <p class="text-gray-500 text-sm italic font-medium leading-relaxed">{{ $m->description }}</p>
                                    </div>
                                </li>
                            @empty
                                <li class="text-gray-400 italic text-xs uppercase font-black tracking-widest">Belum ada misi.</li>
                            @endforelse
                        </ul>
                    </section>
                </div>

                {{-- SISI KANAN: VIDEO & STATS --}}
                <div class="sticky top-32 space-y-12 reveal">
                    <div class="relative">
                        <div class="absolute -top-10 -right-10 w-64 h-64 bg-[#E0F2F1] rounded-full -z-10 animate-pulse"></div>
                        @if(isset($settings['youtube_video_id']))
                            <div class="relative p-4 bg-white shadow-2xl rounded-[4rem] border border-gray-100 transform rotate-2 hover:rotate-0 transition-transform duration-500 group">
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
                        @endif
                    </div>

                    <div class="grid grid-cols-2 gap-6" id="stats-section">
                        <div class="p-8 bg-white border-2 border-[#006064]/10 rounded-[2.5rem] shadow-xl text-center group hover:border-[#006064] transition-colors">
                            <h5 class="text-4xl font-black text-[#006064] italic mb-1"><span class="counter" data-target="100">0</span>+</h5>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-none">Tutor Terseleksi</p>
                        </div>
                        <div class="p-8 bg-white border-2 border-[#FFC107]/20 rounded-[2.5rem] shadow-xl text-center group hover:border-[#FFC107] transition-colors">
                            <h5 class="text-4xl font-black text-[#006064] italic mb-1"><span class="counter" data-target="98">0</span>%</h5>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest leading-none">Tingkat Kepuasan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER MODULAR --}}
    @include('layouts.footer')

    {{-- SCRIPTS --}}
    <script>
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    if (entry.target.id === 'stats-section') startCounters();
                }
            });
        }, { threshold: 0.1 });

        const startCounters = () => {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                let count = 0;
                const update = () => {
                    const speed = 100;
                    const increment = target / speed;
                    if (count < target) {
                        count += increment;
                        counter.innerText = Math.ceil(count);
                        setTimeout(update, 20);
                    } else { counter.innerText = target; }
                };
                update();
            });
        };

        document.querySelectorAll('.reveal, #stats-section').forEach(el => revealObserver.observe(el));
    </script>
</body>
</html>