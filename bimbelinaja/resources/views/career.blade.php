<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karir & Peluang - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        [x-cloak] { display: none !important; }

        /* Kustomisasi Titik Slider (Pagination) */
        .swiper-pagination-bullet-active {
            background: #FFC107 !important;
            width: 20px !important;
            border-radius: 5px !important;
            transition: all 0.3s ease;
        }
        .swiper-pagination-bullet {
            background: #006064;
        }
        .testimonialSwiper {
            padding-bottom: 50px !important;
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900 overflow-x-hidden">

    @include('layouts.nav')

    {{-- HEADER --}}
    <header class="bg-[#004D40] py-24 flex flex-col items-center justify-center text-center relative overflow-hidden border-b-8 border-[#FFC107]">
        <div class="relative z-10 reveal active text-center">
            <h1 class="text-4xl md:text-7xl font-black text-white tracking-widest uppercase italic leading-none px-4">Peluang <span class="text-[#FFC107]">Karir</span></h1>
            <p class="text-teal-200 text-[10px] md:text-xs font-bold uppercase tracking-[0.4em] mt-6 bg-white/5 py-2 px-6 rounded-full inline-block">Ekosistem Pengajar Terbaik</p>
        </div>
    </header>

    <main class="py-24">
        <div class="container mx-auto px-6 md:px-10">
            
            {{-- 1. SEKSI KEUNTUNGAN --}}
            <section class="mb-32 reveal">
                <div class="text-center mb-16">
                    <h2 class="text-2xl md:text-4xl font-black text-[#006064] uppercase italic tracking-tighter">
                        {{ $settings['career_benefit_title'] ?? 'Keuntungan Menjadi' }} <span class="text-[#FFC107]">{{ $settings['career_benefit_brand'] ?? 'Tutor BimbelinAja' }}</span>
                    </h2>
                    <p class="text-gray-400 font-bold mt-2 italic text-sm md:text-base">{{ $settings['career_benefit_subtitle'] ?? 'Bukan hanya pekerjaan, tapi perjalanan pengembangan diri.' }}</p>
                    <div class="w-24 h-2 bg-[#FFC107] mx-auto mt-6 rounded-full"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 text-center">
                    @forelse($benefits as $b)
                        <div class="group p-4 reveal">
                            <div class="w-20 h-20 bg-teal-50 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:bg-[#FFC107] transition-all duration-500 shadow-xl shadow-teal-900/5 p-4">
                                @if($b->image)
                                    <img src="{{ asset('storage/' . $b->image) }}" class="w-full h-full object-contain group-hover:scale-110 transition-transform">
                                @else
                                    <span class="text-3xl">✨</span>
                                @endif
                            </div>
                            <h4 class="text-xl font-black text-[#006064] mb-4 uppercase tracking-tighter italic">{{ $b->title }}</h4>
                            <p class="text-gray-500 italic font-medium leading-relaxed text-sm px-4">{{ $b->description }}</p>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-10 bg-gray-50 rounded-3xl italic text-gray-400 font-bold uppercase tracking-widest text-xs">Belum ada data keuntungan.</div>
                    @endforelse
                </div>
            </section>

            {{-- 3. GRID UTAMA KRITERIA & CTA --}}
            <div class="grid lg:grid-cols-3 gap-16 reveal">
                <div class="lg:col-span-2 space-y-20">
                    <section>
                        <h2 class="text-3xl md:text-4xl font-black text-[#006064] uppercase tracking-tighter mb-8 italic leading-tight">
                            Kenapa Mengajar di <span class="text-[#FFC107]">BimbelinAja?</span>
                        </h2>
                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="p-8 bg-[#F8FAFC] rounded-[2.5rem] border-t-8 border-[#006064] shadow-sm">
                                <h4 class="font-black text-[#006064] uppercase text-xs tracking-widest mb-4 italic">{{ $settings['career_f1_title'] ?? 'Akreditasi Sistem' }}</h4>
                                <p class="text-gray-500 text-sm italic leading-relaxed">{{ $settings['career_f1_desc'] ?? 'Sistem manajemen pengajaran kami telah terstandarisasi menjamin kualitas tutor.' }}</p>
                            </div>
                            <div class="p-8 bg-[#F8FAFC] rounded-[2.5rem] border-t-8 border-[#FFC107] shadow-sm">
                                <h4 class="font-black text-[#006064] uppercase text-xs tracking-widest mb-4 italic">{{ $settings['career_f2_title'] ?? 'Pelatihan Rutin' }}</h4>
                                <p class="text-gray-500 text-sm italic leading-relaxed">{{ $settings['career_f2_desc'] ?? 'Setiap tutor mendapatkan akses ke workshop pedagogi secara berkala.' }}</p>
                            </div>
                        </div>
                    </section>

                    <section>
                        <h3 class="text-2xl font-black text-[#006064] uppercase tracking-tight mb-8 italic">{{ $settings['career_criteria_title'] ?? 'Kriteria Utama Kami' }}</h3>
                        <div class="space-y-4">
                            @php 
                                $criteriaList = [
                                    $settings['career_c1'] ?? 'Mahasiswa aktif atau Lulusan S1/S2 universitas ternama.',
                                    $settings['career_c2'] ?? 'Memiliki IPK minimal 3.25 (untuk mata pelajaran eksakta).',
                                    $settings['career_c3'] ?? 'Mampu berkomunikasi dengan baik dan sabar.',
                                    $settings['career_c4'] ?? 'Memiliki laptop dan koneksi internet stabil.'
                                ];
                            @endphp
                            @foreach($criteriaList as $item)
                                @if($item)
                                <div class="flex items-center p-5 bg-white border border-gray-100 rounded-2xl shadow-sm hover:translate-x-2 transition-transform">
                                    <div class="w-2 h-2 bg-[#FFC107] rounded-full mr-4"></div>
                                    <p class="text-sm font-bold text-gray-600 italic">{{ $item }}</p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </section>
                </div>

                {{-- SIDEBAR CTA --}}
                <div class="lg:col-span-1">
                    <div class="bg-[#006064] p-10 rounded-[3rem] shadow-2xl sticky top-32 text-white border-b-8 border-teal-900">
                        <h3 class="text-xl font-black uppercase tracking-tighter mb-6 italic">{{ $settings['career_cta_title'] ?? 'Siap Bergabung?' }}</h3>
                        <p class="text-teal-200 text-xs italic mb-8 leading-relaxed">{{ $settings['career_cta_desc'] ?? 'Kirimkan CV, Transkrip Nilai, dan Sertifikat melalui tombol di bawah ini.' }}</p>
                        <div class="space-y-6 mb-10 text-white/80 text-[10px] font-black uppercase tracking-widest">
                            <div class="flex items-center space-x-4"><span class="bg-white/10 p-2 rounded-lg">✅</span> <span>Seleksi Berkas</span></div>
                            <div class="flex items-center space-x-4"><span class="bg-white/10 p-2 rounded-lg">✅</span> <span>Micro Teaching</span></div>
                            <div class="flex items-center space-x-4"><span class="bg-white/10 p-2 rounded-lg">✅</span> <span>Interview</span></div>
                        </div>
                        <a href="{{ $settings['career_whatsapp_url'] ?? 'https://wa.me/6283102064517' }}" class="block text-center bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 rounded-2xl transition-all shadow-xl uppercase tracking-[0.2em] text-[10px] active:scale-95">
                            Kirim Lamaran (WA)
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Reveal Animation
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { 
                if (entry.isIntersecting) entry.target.classList.add('active'); 
            });
        }, observerOptions);
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Swiper Slider Init
        var swiper = new Swiper(".testimonialSwiper", {
            loop: true,
            autoHeight: true,
            spaceBetween: 30,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    </script>
</body>
</html>