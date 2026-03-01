<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jenjang {{ $program->name }} - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-[#F8FAFC] text-gray-900 overflow-x-hidden">

    @include('layouts.nav')

    {{-- HEADER (HERO) --}}
    <header class="bg-[#004D40] py-24 text-center relative overflow-hidden border-b-8 border-[#FFC107]">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle,white_1px,transparent_1px)] bg-[length:20px_20px]"></div>
        <div class="relative z-10 px-6">
            <div class="w-24 h-24 bg-white rounded-3xl mx-auto mb-8 p-4 shadow-2xl flex items-center justify-center transform rotate-3">
                {{-- PERBAIKAN PATH ICON PROGRAM --}}
                <img src="{{ asset($program->icon) }}" class="w-full h-full object-contain" alt="Icon">
            </div>
            <h1 class="text-4xl md:text-7xl font-black text-white tracking-widest uppercase italic leading-none mb-4">
                Jenjang <span class="text-[#FFC107]">{{ $program->name }}</span>
            </h1>
            <p class="text-teal-200 text-[10px] md:text-xs font-bold uppercase tracking-[0.5em] bg-white/5 py-2 px-6 rounded-full inline-block">Mata Pelajaran Terseleksi</p>
        </div>
    </header>

    {{-- MAIN DAFTAR MATA PELAJARAN --}}
    <main class="py-24">
        <div class="container mx-auto px-6 md:px-10">
            <div class="mb-14 text-center">
                <h2 class="text-3xl md:text-4xl font-black text-[#006064] tracking-tight uppercase italic">Mau Belajar Apa?</h2>
                <div class="w-20 h-1.5 bg-[#FFC107] mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($program->subPrograms as $sub)
                    <div class="group">
                        <a href="{{ route('admin.programs.katalog', $sub->id) }}" 
                           class="relative bg-white p-10 rounded-[3.5rem] shadow-xl shadow-teal-900/5 border border-gray-100 flex flex-col items-center justify-center overflow-hidden transition-all duration-500 hover:-translate-y-3 hover:shadow-yellow-500/20 hover:border-[#FFC107]/30 h-full">
                            
                            <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-teal-50 rounded-full group-hover:scale-[2] transition-transform duration-700 opacity-50"></div>
                            
                            <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center mb-6 p-3 group-hover:bg-[#FFC107] transition-all duration-500 relative z-10 shadow-sm">
                                {{-- PERBAIKAN PATH ICON SUB PROGRAM --}}
                               @if($sub->image && file_exists(public_path($sub->image)))
    <img src="{{ asset($sub->image) }}" 
         class="w-full h-full object-contain"
         alt="{{ $sub->name }}">
@else
    <span class="text-2xl">📖</span>
@endif
                            </div>

                            <span class="relative z-10 text-[#006064] font-black uppercase italic tracking-widest text-lg group-hover:text-teal-800 transition-colors text-center">
                                {{ $sub->name }}
                            </span>
                            
                            <div class="relative z-10 mt-6 flex items-center bg-teal-50 px-5 py-2 rounded-full opacity-0 group-hover:opacity-100 transition-all transform translate-y-4 group-hover:translate-y-0 shadow-sm">
                                <span class="text-[8px] font-black uppercase tracking-widest text-teal-600">Lihat Detail Program</span>
                                <svg class="w-3 h-3 ml-2 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-24 bg-white/50 rounded-[4rem] border-4 border-dashed border-gray-100 text-center">
                        <p class="font-black text-[#006064] uppercase italic tracking-widest opacity-40">Belum ada mata pelajaran tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>

    @include('layouts.footer')

</body>
</html>