{{-- NAVBAR RESPONSIVE MODULAR --}}
<nav class="sticky top-0 z-50 bg-white/90 backdrop-blur-md shadow-sm" x-data="{ mobileMenuOpen: false }">
    <div class="flex items-center justify-between px-6 md:px-10 py-5">
        {{-- LOGO --}}
        <div class="flex items-center space-x-2">
            <a href="{{ route('home') }}" class="flex items-center space-x-2 text-[#006064]">
                <div class="bg-[#006064] p-2 rounded-lg shadow-sm">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                </div>
                <span class="text-xl md:text-2xl font-bold uppercase tracking-tighter text-[#006064]">Bimbelin<span class="text-teal-500">Aja</span></span>
            </a>
        </div>
        
        {{-- DESKTOP MENU --}}
        <div class="hidden md:flex space-x-8 text-[#006064] font-black uppercase text-[10px] tracking-[0.2em] items-center">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-teal-600' : 'hover:text-teal-600' }} transition">Home</a>
            
            {{-- DROPDOWN LAYANAN --}}
            <div class="relative dropdown group py-2">
                <button class="flex items-center hover:text-teal-600 transition uppercase outline-none font-black {{ request()->routeIs('online.public') || request()->routeIs('programs.public') ? 'text-teal-600' : '' }}">
                    Layanan
                    <svg class="w-4 h-4 ml-1 transform group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                
                {{-- MENU DROPDOWN (FIXED: Tambah group-hover classes agar tampil) --}}
                <div class="dropdown-menu absolute opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto group-hover:translate-y-0 transform -translate-y-2 bg-white shadow-2xl rounded-2xl p-4 w-56 mt-4 border border-gray-100 transition-all duration-300 z-[60]">
                    
                    {{-- Jembatan Transparan --}}
                    <div class="absolute -top-6 left-0 w-full h-8 bg-transparent"></div>

                    <div class="flex flex-col space-y-1 relative z-10">
                        <a href="{{ route('programs.public') }}" class="p-3 rounded-xl hover:bg-teal-50 transition text-[10px] font-black uppercase tracking-widest text-[#006064] flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#FFC107] rounded-full mr-2"></span>
                            Les Privat
                        </a>
                        <a href="{{ route('online.public') }}" class="p-3 rounded-xl hover:bg-teal-50 transition text-[10px] font-black uppercase tracking-widest text-[#006064] flex items-center">
                            <span class="w-1.5 h-1.5 bg-[#FFC107] rounded-full mr-2"></span>
                            Les Online
                        </a>
                    </div>
                </div>
            </div>

            <a href="{{ route('programs.public') }}" class="{{ request()->routeIs('programs.public') ? 'text-teal-600 border-b-2 border-[#FFC107]' : 'hover:text-teal-600' }} pb-1 transition">Program Les</a>
            <a href="{{ route('about.public') }}" class="{{ request()->routeIs('about.public') ? 'text-teal-600 border-b-2 border-[#FFC107]' : 'hover:text-teal-600' }} pb-1 transition">Tentang</a>
            <a href="{{ route('career.public') }}" class="{{ request()->routeIs('career.public') ? 'text-teal-600 border-b-2 border-[#FFC107]' : 'hover:text-teal-600' }} pb-1 transition">Karir</a>
            <a href="{{ route('contact.public') }}" class="{{ request()->routeIs('contact.public') ? 'text-teal-600 border-b-2 border-[#FFC107]' : 'hover:text-teal-600' }} pb-1 transition">Hubungi Kami</a>
        </div>

        {{-- WA & HAMBURGER --}}
        <div class="flex items-center space-x-4">
            <a href="https://wa.me/6283102064517" target="_blank" class="hidden sm:inline-flex bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-3 px-8 rounded-2xl transition shadow-lg uppercase tracking-widest text-xs">WhatsApp</a>
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-[#006064] p-2 focus:outline-none">
                <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <svg x-show="mobileMenuOpen" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div x-show="mobileMenuOpen" x-cloak x-transition class="md:hidden bg-white border-t border-gray-100 shadow-2xl absolute w-full left-0 z-50">
        <div class="flex flex-col p-6 space-y-4 text-[#006064] font-black uppercase text-[11px] tracking-widest">
            <a href="{{ route('home') }}" class="py-2 border-b {{ request()->routeIs('home') ? 'text-teal-600' : '' }}">Home</a>
            
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex justify-between items-center py-2 border-b uppercase font-black">
                    Layanan 
                    <svg class="w-4 h-4 transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div x-show="open" x-cloak class="bg-teal-50/50 rounded-xl mt-2 p-2">
                    <a href="{{ route('programs.public') }}" class="block p-3 text-[10px] lowercase italic font-bold">Les Privat</a>
                    <a href="{{ route('online.public') }}" class="block p-3 text-[10px] lowercase italic font-bold">Les Online</a>
                </div>
            </div>

            <a href="{{ route('programs.public') }}" class="py-2 border-b">Program Les</a>
            <a href="{{ route('about.public') }}" class="py-2 border-b">Tentang</a>
            <a href="{{ route('career.public') }}" class="py-2 border-b">Karir</a>
            <a href="{{ route('contact.public') }}" class="py-2 border-b">Hubungi Kami</a>
            <a href="https://wa.me/6283102064517" target="_blank" class="bg-[#FFC107] text-[#006064] text-center py-4 rounded-2xl font-black mt-4 shadow-lg">WhatsApp</a>
        </div>
    </div>
</nav>