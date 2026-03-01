<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - BimbelinAja Signature</title>
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
<body class="font-sans antialiased bg-[#F8FAFC] text-gray-900 overflow-x-hidden">

    @include('layouts.nav')

    {{-- HEADER (HERO) --}}
    <header class="bg-[#004D40] py-24 text-center relative overflow-hidden border-b-8 border-[#FFC107]">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle,white_1px,transparent_1px)] bg-[length:20px_20px]"></div>
        <div class="relative z-10 reveal active px-6">
            <h1 class="text-4xl md:text-7xl font-black text-white tracking-widest uppercase italic leading-none">
                {!! $settings['contact_hero_title'] ?? 'HUBUNGI <span class="text-[#FFC107]">KAMI</span>' !!}
            </h1>
            <p class="text-teal-200 text-[10px] md:text-xs font-bold uppercase tracking-[0.5em] mt-6 bg-white/5 py-2 px-6 rounded-full inline-block">
                {{ $settings['contact_hero_subtitle'] ?? 'BANTUAN & LAYANAN KONSULTASI BIMBELINAJA' }}
            </p>
        </div>
    </header>

    <main class="py-24">
        <div class="container mx-auto px-6 md:px-10">
            
            {{-- SEKSI 1: JADWAL & CHAT WA --}}
            <div class="grid lg:grid-cols-2 gap-12 mb-32 items-center">
                <div class="reveal">
                    <div class="inline-block px-4 py-2 bg-teal-50 text-[#006064] rounded-lg mb-6 text-[10px] font-black uppercase tracking-[0.3em]">
                        {{ $settings['contact_support_title'] ?? 'DIRECT SUPPORT' }}
                    </div>
                    <h2 class="text-3xl md:text-5xl font-black text-[#006064] uppercase tracking-tighter mb-8 italic leading-tight">
                        {!! $settings['contact_chat_title'] ?? 'Butuh Respon <span class="text-[#FFC107]">Cepat?</span> <br> Chat Konsultan Kami' !!}
                    </h2>
                    <p class="text-gray-500 font-bold italic text-sm mb-10 leading-relaxed max-w-md">
                        {{ $settings['contact_chat_desc'] ?? 'Klik tombol di bawah untuk terhubung langsung dengan admin kami via WhatsApp. Kami siap membantu menjawab pertanyaan Anda.' }}
                    </p>

                    <a href="https://wa.me/6283102064517" target="_blank"
                       class="inline-flex items-center bg-[#25D366] text-white font-black py-5 px-10 rounded-[2.5rem] hover:bg-[#128C7E] transition shadow-2xl shadow-green-900/20 uppercase tracking-widest text-[10px] group active:scale-95">
                        <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981z"/></svg>
                        Hubungi Lewat Whatsapp
                    </a>
                </div>

                <div class="bg-[#006064] p-8 md:p-12 rounded-[3rem] md:rounded-[4rem] shadow-2xl relative overflow-hidden text-white border-b-[12px] border-teal-900 reveal">
                    <h3 class="text-[#FFC107] font-black uppercase text-xs tracking-[0.4em] mb-10 border-b border-white/10 pb-6 italic">Jadwal Operasional</h3>
                    <div class="space-y-6">
                        <div class="flex justify-between items-center p-5 bg-white/5 rounded-2xl hover:bg-white/10 transition-colors">
                            <span class="font-black text-[10px] uppercase tracking-widest text-teal-100">Senin - Jumat</span>
                            <span class="font-black italic text-sm">{{ $settings['contact_mon_fri'] ?? '08:00 - 21:00' }}</span>
                        </div>
                        <div class="flex justify-between items-center p-5 bg-white/5 rounded-2xl border-l-4 border-[#FFC107] hover:bg-white/10 transition-colors">
                            <span class="font-black text-[10px] uppercase tracking-widest text-teal-100">Sabtu</span>
                            <span class="font-black italic text-sm">{{ $settings['contact_sat'] ?? '09:00 - 18:00' }}</span>
                        </div>
                        <div class="flex justify-between items-center p-5 bg-red-500/10 rounded-2xl">
                            <span class="font-black text-[10px] uppercase tracking-widest text-red-200">Minggu</span>
                            <span class="font-bold italic text-xs text-red-100 opacity-60">{{ $settings['contact_sun'] ?? 'Libur (Slow Respon)' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- SEKSI GOOGLE MAPS --}}
<div class="grid lg:grid-cols-2 gap-12 mb-32 items-stretch reveal">
    <div class="bg-white p-8 md:p-12 rounded-[3rem] md:rounded-[4rem] shadow-xl border border-gray-100 flex flex-col items-center justify-center text-center">
        <div class="bg-[#006064] p-6 rounded-3xl shadow-lg mb-8">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <address class="text-[#006064] font-black text-sm leading-relaxed mb-10 max-w-md italic uppercase tracking-tight not-italic">
            {!! $settings['contact_address'] ?? 'GG. KAMBOJA JL. SONOPAKIS LOR NO.186 RT07, <br>NGESTIHARJO, KEC. KASIHAN, KABUPATEN BANTUL, DIY 55182' !!}
        </address>
        
        <a href="{{ $settings['contact_map_url'] ?? '#' }}" target="_blank" 
           class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 px-10 rounded-2xl transition shadow-lg flex items-center uppercase tracking-widest text-[10px] group">
            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path></svg>
            Petunjuk Arah
        </a>
    </div>

    <div class="rounded-[3rem] md:rounded-[4rem] overflow-hidden shadow-2xl border-8 border-white min-h-[350px]">
        {{-- BAGIAN YANG DIUBAH: Menghapus class grayscale --}}
        <iframe class="w-full h-full"
            src="{{ $settings['contact_map_embed'] ?? 'https://www.google.com/maps/embed?pb=...' }}" 
            style="border:0; min-height: 400px;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>

            {{-- FORM TINGGALKAN PESAN --}}
            <div class="max-w-5xl mx-auto reveal">
                <div class="bg-white rounded-[3rem] md:rounded-[4rem] shadow-2xl p-8 md:p-20 border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-10 opacity-5">
                        <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>
                    </div>

                    <div class="text-center mb-16 relative z-10">
                        <h2 class="text-3xl md:text-4xl font-black text-[#006064] uppercase tracking-tighter italic">
                            {!! $settings['contact_form_title'] ?? 'Tinggalkan <span class="text-[#FFC107]">Pesan</span>' !!}
                        </h2>
                        <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] mt-4">
                            {{ $settings['contact_form_subtitle'] ?? 'Kritik, saran, atau aduan Anda sangat berarti bagi kami' }}
                        </p>
                    </div>

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-8 relative z-10">
                        @csrf
                        
                        @if(session('success'))
                            <div class="bg-teal-50 border-2 border-teal-100 text-[#006064] p-6 rounded-[2rem] mb-10 font-bold text-sm italic text-center">
                                {{ session('success') }} ✨
                            </div>
                        @endif

                        <div class="grid md:grid-cols-2 gap-8">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Nama Lengkap</label>
                                <input type="text" name="name" placeholder="Contoh: Abdul Fathir" required 
                                       class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Alamat Email</label>
                                <input type="email" name="email" placeholder="email@anda.com" required 
                                       class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-3xl px-8 py-5 outline-none transition-all font-bold text-sm">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-4 italic">Isi Pesan / Aduan</label>
                            <textarea name="message" rows="5" placeholder="Tuliskan pesan Anda di sini..." required 
                                      class="w-full bg-[#F8FAFC] border-2 border-transparent focus:border-[#006064] focus:bg-white rounded-[2.5rem] px-8 py-6 outline-none transition-all font-bold text-sm resize-none"></textarea>
                        </div>

                        <div class="text-center pt-6">
                            <button type="submit" 
                                    class="w-full md:w-auto bg-[#006064] text-white font-black py-6 px-16 rounded-3xl hover:bg-teal-900 transition-all shadow-2xl uppercase tracking-widest text-xs flex items-center justify-center mx-auto group active:scale-95">
                                Kirim Pesan Sekarang
                                <svg class="w-5 h-5 ml-4 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    {{-- FOOTER MODULAR --}}
    @include('layouts.footer')

    {{-- SCRIPTS --}}
    <script>
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('active'); });
        }, observerOptions);
        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
    </script>
</body>
</html>