<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $program->name }} - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gradasi lembut sesuai image_8ef674.png */
        .bg-edu-detail {
            background: linear-gradient(to bottom, #E0F2F1, #FFFFFF, #FFF9C4);
        }
    </style>
</head>
<body class="font-sans antialiased bg-edu-detail min-h-screen">

    <nav class="flex items-center justify-between px-10 py-5 bg-white/80 backdrop-blur-md sticky top-0 z-50">
        <div class="flex items-center space-x-2">
            <a href="{{ url('/') }}" class="flex items-center space-x-2">
                <div class="bg-[#006064] p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-2xl font-bold text-[#006064] uppercase tracking-tighter">Bimbelin<span class="text-teal-500">Aja</span></span>
            </a>
        </div>
        <a href="{{ route('programs.public') }}" class="text-[#006064] font-black uppercase text-[10px] tracking-widest hover:text-teal-600 transition border-b-2 border-[#FFC107]">Kembali ke Program</a>
    </nav>

    <main class="py-20 px-6 max-w-7xl mx-auto text-center">
        <div class="mb-16 flex flex-col items-center">
            <div class="w-28 h-28 mb-6 p-4 bg-white rounded-3xl shadow-xl transition-transform hover:scale-110 duration-500">
                <img src="{{ asset('storage/' . $program->icon) }}" alt="{{ $program->name }}" class="w-full h-full object-contain">
            </div>
            <h1 class="text-4xl md:text-5xl font-black text-[#006064] uppercase tracking-tighter italic">
                {{ $program->name }}
            </h1>
            <div class="w-24 h-2 bg-[#FFC107] mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($program->subPrograms as $sub)
                <a href="{{ route('katalog', ['sub' => $sub->id]) }}" 
                   class="bg-white hover:bg-[#E0F2F1] text-[#006064] font-black py-6 px-10 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border border-gray-50 flex items-center justify-center text-center uppercase tracking-widest text-sm italic group">
                    <span class="group-hover:scale-110 transition-transform">{{ $sub->name }}</span>
                </a>
            @empty
                <div class="col-span-full py-10">
                    <p class="text-gray-400 font-bold italic uppercase tracking-widest">Belum ada mata pelajaran tersedia untuk program ini.</p>
                </div>
            @endforelse
        </div>
    </main>

</body>
</html>