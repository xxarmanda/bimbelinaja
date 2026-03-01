<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - BimbelinAja</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Wajib ada untuk tombol menu mobile --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-900 overflow-x-hidden" x-data="{ sidebarOpen: false }">

    {{-- OVERLAY MOBILE --}}
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         x-cloak
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-[#006064]/60 backdrop-blur-sm z-40 lg:hidden"></div>

    <div class="flex min-h-screen">
        {{-- SIDEBAR: Tambahkan ID main-sidebar untuk kontrol scroll --}}
        <aside id="main-sidebar"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="w-72 border-r border-gray-200 flex flex-col fixed h-screen bg-white z-50 transition-transform duration-300 ease-in-out overflow-y-auto custom-scrollbar shadow-2xl lg:shadow-none">
            
            {{-- Logo Area --}}
            <div class="p-6 flex items-center justify-between">
                <a href="/" class="flex items-center space-x-2 group">
                    <div class="bg-[#006064] p-2 rounded-lg shrink-0 shadow-sm group-hover:rotate-6 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-black text-[#006064] tracking-tighter uppercase leading-none">
                        Bimbelin<span class="text-teal-500">Aja</span>
                    </span>
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 space-y-1 mt-4">
                {{-- SECTION 1: MAIN --}}
                <div class="pb-4">
                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-3 ml-3 italic">Dashboard Utama</p>
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100 hover:text-[#006064]' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        <span class="font-bold text-sm">Dashboard</span>
                    </a>
                </div>

                <hr class="mx-3 border-gray-100 mb-4">

                {{-- SECTION 2: MASTER DATA --}}
                <div class="pb-4">
                    <p class="text-[10px] font-black text-[#006064]/50 uppercase tracking-[0.2em] mb-3 ml-3 italic">Manajemen Master</p>
                    <a href="{{ route('admin.programs.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.programs.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Kelola Jenjang</span>
                    </a>
                    <a href="{{ route('admin.sub-programs.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.sub-programs.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Mata Pelajaran</span>
                    </a>
                    <a href="{{ route('admin.tutors.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.tutors.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Kelola Tutor</span>
                    </a>
                    <a href="{{ route('admin.service-areas.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.service-areas.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Area Layanan</span>
                    </a>
                </div>

                <hr class="mx-3 border-gray-100 mb-4">

                {{-- SECTION 3: CONTENT MANAGEMENT --}}
                <div class="pb-4">
                    <p class="text-[10px] font-black text-[#006064]/50 uppercase tracking-[0.2em] mb-3 ml-3 italic">Konten & Visual</p>
                    <a href="{{ route('admin.sliders.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.sliders.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Kelola Slider</span>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.settings.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Link Video</span>
                    </a>
                    <a href="{{ route('admin.missions.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.missions.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Visi dan Misi</span>
                    </a>
                    
                    {{-- MENU TESTIMONI SISWA --}}
                    <a href="{{ route('admin.testimonials.index') }}" 
                    class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.testimonials.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        
                        {{-- Ikon Chat/Kutipan --}}
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>

                        <span class="font-bold text-sm">Testimoni Siswa</span>
                    </a>

                    <a href="{{ route('admin.online-settings.index') }}" 
                       class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.online-settings.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-bold text-sm">Konten Les Online</span>
                    </a>
                </div>

                <hr class="mx-3 border-gray-100 mb-4">

                {{-- SECTION 4: SALES & SUPPORT --}}
                <div class="pb-4">
                    <p class="text-[10px] font-black text-[#006064]/50 uppercase tracking-[0.2em] mb-3 ml-3 italic">Registrasi & Layanan</p>
                    <a href="{{ route('admin.transactions.index') }}" class="sidebar-link flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('admin.transactions.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2-2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            <span class="font-bold text-sm">Data Pendaftaran</span>
                        </div>
                        @php $pendingPayments = \App\Models\Transaction::where('status', 'pending')->whereNotNull('proof_of_payment')->count(); @endphp
                        @if($pendingPayments > 0)
                            <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full animate-pulse shadow-sm">{{ $pendingPayments }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.payment-configs.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.payment-configs.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Info Pembayaran</span>
                    </a>
                    <a href="{{ route('admin.benefits.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.benefits.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Kelola Karir</span>
                    </a>
                    <a href="{{ route('admin.registration-steps.index') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.registration-steps.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Cara Daftar</span>
                    </a>
                    <a href="{{ route('admin.contact.settings') }}" class="sidebar-link flex items-center space-x-3 p-3 rounded-xl transition-all {{ request()->routeIs('admin.contact.settings') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        <span class="font-bold text-sm">Hubungi Kami</span>
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="sidebar-link flex items-center justify-between p-3 rounded-xl transition-all {{ request()->routeIs('admin.messages.*') ? 'bg-teal-50 text-[#006064] border-r-4 border-yellow-400 active-menu' : 'text-gray-500 hover:bg-gray-100' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v10a2 2 0 002 2z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                            <span class="font-bold text-sm">Pesan Masuk</span>
                        </div>
                        @if(isset($unreadCount) && $unreadCount > 0)
                            <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full animate-pulse shadow-sm">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
            </nav>

            {{-- Logout Section --}}
            <div class="p-4 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center p-3 text-red-500 hover:bg-red-50 rounded-xl transition font-black group italic">
                        <svg class="w-6 h-6 mr-3 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- MAIN CONTENT AREA --}}
        <main class="flex-1 min-h-screen transition-all duration-300 lg:ml-72">
            
            {{-- HEADER DINAMIS --}}
            <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-100 p-6 lg:p-8 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-[#006064] bg-teal-50 rounded-xl focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    
                    <div>
                        <h1 class="text-xl md:text-2xl font-black text-[#006064] uppercase tracking-tighter leading-none">
                            {{ $header ?? 'Dashboard Utama' }}
                        </h1>
                        <p class="hidden sm:block text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">BimbelinAja Management System</p>
                    </div>
                </div>
                
                <div class="flex items-center space-x-4 bg-gray-50 py-2 px-3 md:px-5 rounded-[1.5rem] border border-gray-100">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-black text-gray-800 leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[8px] text-teal-600 font-black uppercase tracking-widest mt-1 italic">Super Admin</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=006064&color=fff&bold=true" 
                         class="w-8 h-8 md:w-10 md:h-10 rounded-xl shadow-md border-2 border-white" alt="Avatar">
                </div>
            </header>
            
            <div class="p-6 md:p-10 animate-fade-in">
                @yield('content') 
                @isset($slot)
                    {{ $slot }}
                @endisset
            </div>
        </main>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #006064; }
        .animate-fade-in { animation: fadeIn 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    {{-- SCRIPT SCROLL MANAGER --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('main-sidebar');
            
            // 1. Ambil posisi scroll terakhir
            const scrollPos = sessionStorage.getItem('sidebar-scroll');
            if (scrollPos) {
                sidebar.scrollTop = scrollPos;
            }

            // 2. Simpan posisi scroll setiap kali link diklik
            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            sidebarLinks.forEach(link => {
                link.addEventListener('click', () => {
                    sessionStorage.setItem('sidebar-scroll', sidebar.scrollTop);
                });
            });

            // 3. Otomatis Scroll ke menu aktif
            const activeMenu = document.querySelector('.active-menu');
            if (activeMenu) {
                activeMenu.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    </script>
</body>
</html>