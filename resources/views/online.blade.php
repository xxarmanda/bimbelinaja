<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Online - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .reveal { opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; }
        .reveal.active { opacity: 1; transform: translateY(0); }
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="bg-white font-sans antialiased text-gray-900"
      x-data="{ mobileMenuOpen: false, layananOpen: false }">

@include('layouts.nav')

{{-- ================= HERO ================= --}}
@php 
    $hero = $onlineSettings['hero'] ?? null;

    $heroImage = $hero->image ?? null;
    if($heroImage){
        $heroImage = str_replace('uploads/les_online/online_page/', 'uploads/online_page/', $heroImage);
        $heroImage = str_replace('les_online/online_page/', 'uploads/online_page/', $heroImage);
        $heroImage = str_replace('online_page/online_page/', 'online_page/', $heroImage);
    }
@endphp

<section class="bg-[#006064] py-24 px-6 text-white overflow-hidden relative">
    <div class="max-w-7xl mx-auto grid md:grid-cols-2 items-center gap-16 relative z-10">

        <div class="reveal active">
            <h1 class="text-4xl md:text-5xl font-black mb-8 leading-tight uppercase italic tracking-tighter">
                {{ $hero->title ?? 'Les Privat Online & Interaktif' }}
            </h1>
            <p class="text-teal-50 text-lg leading-relaxed mb-10 font-medium">
                {{ $hero->description ?? '' }}
            </p>

            <a href="{{ route('programs.public') }}"
               class="bg-[#FFC107] text-[#006064] font-black py-4 px-10 rounded-xl shadow-xl uppercase text-[10px] tracking-widest hover:bg-yellow-500 transition-all active:scale-95">
                Detail Program & Daftar Sesuai Jenjang Sekolahmu...
            </a>
        </div>

        <div class="relative flex justify-center reveal active">
            @if($heroImage)
                <img src="{{ asset($heroImage) }}"
                     class="w-full max-w-lg rounded-[3rem] shadow-2xl border-8 border-white/10 rotate-2 transition-transform hover:rotate-0 duration-500">
            @endif
        </div>

    </div>
</section>


{{-- ================= FEATURES ================= --}}
<section class="py-24 px-6 max-w-7xl mx-auto grid md:grid-cols-3 gap-10">

@foreach(['feature_1', 'feature_2', 'feature_3'] as $sec)

    @php 
        $f = $onlineSettings[$sec] ?? null;

        $featureImage = $f->image ?? null;
        if($featureImage){
            $featureImage = str_replace('uploads/les_online/online_page/', 'uploads/online_page/', $featureImage);
            $featureImage = str_replace('les_online/online_page/', 'uploads/online_page/', $featureImage);
            $featureImage = str_replace('online_page/online_page/', 'online_page/', $featureImage);
        }
    @endphp

    <div class="bg-white p-12 rounded-[2.5rem] shadow-2xl text-center border border-gray-50 reveal">

        @if($featureImage)
            <img src="{{ asset($featureImage) }}" class="h-20 mx-auto mb-8">
        @endif

        <h3 class="text-xl font-black text-[#006064] mb-6 uppercase italic">
            {{ $f->title ?? 'Judul Seksi' }}
        </h3>

        <p class="text-gray-400 text-sm leading-relaxed font-bold uppercase tracking-tight">
            {{ $f->description ?? '' }}
        </p>

    </div>

@endforeach
</section>


{{-- ================= BENEFITS ================= --}}
<section class="py-24 px-6 max-w-7xl mx-auto bg-[#F8FAFC] rounded-[4rem] my-10 shadow-inner">

    <div class="text-center mb-20">
        <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">
            Pilihan Privat Online Terbaik
        </h2>
        <div class="w-20 h-1 bg-[#FFC107] mx-auto mt-4 rounded-full"></div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-y-20 gap-x-12">

    @foreach(['benefit_1', 'benefit_2', 'benefit_3', 'benefit_4', 'benefit_5', 'benefit_6'] as $sec)

        @php 
            $b = $onlineSettings[$sec] ?? null;

            $benefitImage = $b->image ?? null;
            if($benefitImage){
                $benefitImage = str_replace('uploads/les_online/online_page/', 'uploads/online_page/', $benefitImage);
                $benefitImage = str_replace('les_online/online_page/', 'uploads/online_page/', $benefitImage);
                $benefitImage = str_replace('online_page/online_page/', 'online_page/', $benefitImage);
            }
        @endphp

        <div class="flex flex-col items-center text-center reveal group">

            <div class="w-16 h-16 bg-[#006064] rounded-2xl flex items-center justify-center mb-6 shadow-lg">

                @if($benefitImage)
                    <img src="{{ asset($benefitImage) }}" class="w-8 h-8">
                @endif

            </div>

            <h4 class="font-black text-[#006064] mb-3 uppercase text-sm italic tracking-widest">
                {{ $b->title ?? '' }}
            </h4>

            <p class="text-gray-400 text-[10px] leading-relaxed px-4 font-bold uppercase tracking-tight">
                {{ $b->description ?? '' }}
            </p>

        </div>

    @endforeach
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

<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('active');
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>

</body>
</html>