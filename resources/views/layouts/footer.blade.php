{{-- resources/views/layouts/footer.blade.php --}}

{{-- FOOTER UTAMA --}}
<footer class="bg-[#004D40] text-white pt-20 pb-10 relative overflow-hidden border-t-8 border-[#FFC107]">
    <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-[#FFC107]/5 rounded-full blur-3xl"></div>
    <div class="container mx-auto px-10 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 items-start">
            
            {{-- Kolom 1: CTA BOX --}}
            <div>
                <div class="bg-[#006064] p-8 rounded-[2.5rem] shadow-2xl border-2 border-white/10">
                    <h4 class="text-[#FFC107] font-black uppercase text-[10px] tracking-[0.3em] mb-4 italic">Just Call Me!</h4>
                    <p class="text-teal-100/80 text-xs font-bold mb-6 italic italic">Konsultasi gratis soal jenjang & tutor via WhatsApp.</p>
                    <a href="https://wa.me/6283102064517" target="_blank" class="bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-4 px-6 rounded-2xl transition-all shadow-lg flex items-center justify-center uppercase tracking-widest text-[9px]">Hubungi WA</a>
                </div>
            </div>
            
            {{-- Kolom 2: NAVIGASI --}}
            <div>
                <h4 class="text-teal-200/50 font-black uppercase text-[9px] mb-8 border-b border-white/5 pb-2">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest">Home</a></li>
                    <li><a href="{{ route('about.public') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest">Tentang Kami</a></li>
                    <li><a href="{{ route('career.public') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest">Karir</a></li>
                    <li><a href="{{ route('contact.public') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest">Hubungi Kami</a></li>
                </ul>
            </div>
            
            {{-- Kolom 3: LAYANAN (DISESUAIKAN DENGAN NAVBAR) --}}
            <div>
                <h4 class="text-teal-200/50 font-black uppercase text-[9px] mb-8 border-b border-white/5 pb-2">Layanan Kami</h4>
                <ul class="space-y-4">
                    {{-- FIX: Menggunakan rute yang sama dengan navbar --}}
                    <li>
                        <a href="{{ route('programs.public') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest flex items-center group">
                            <span class="w-1.5 h-1.5 bg-[#FFC107] rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Les Privat (Offline)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('online.public') }}" class="text-teal-50 hover:text-[#FFC107] transition text-[10px] font-black uppercase tracking-widest flex items-center group">
                            <span class="w-1.5 h-1.5 bg-[#FFC107] rounded-full mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></span>
                            Les Online (Interaktif)
                        </a>
                    </li>
                </ul>
            </div>
            
            {{-- Kolom 4: BRAND & SOSMED --}}
            <div>
                <span class="text-xl font-black uppercase tracking-tighter text-white">Bimbelin<span class="text-[#FFC107]">Aja</span></span>
                <address class="text-teal-100/60 text-[10px] font-bold mt-4 mb-8 not-italic uppercase tracking-wider leading-relaxed">
                    Gg. Kamboja Jl. Sonopakis Lor No.186 RT07, <br>Ngestiharjo, Kec. Kasihan, Bantul, DIY 55182
                </address>

                <div class="flex items-center space-x-3">
                    <a href="https://instagram.com/armandaaaa22_" target="_blank" class="group flex items-center justify-center w-10 h-10 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#FFC107] hover:border-[#FFC107] transition-all duration-500 shadow-xl">
                        <svg class="w-5 h-5 text-teal-50 group-hover:text-[#004D40] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="https://www.tiktok.com/@bimbelinaja.sda" target="_blank" class="group flex items-center justify-center w-10 h-10 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#FFC107] hover:border-[#FFC107] transition-all duration-500 shadow-xl">
                        <svg class="w-4 h-4 text-teal-50 group-hover:text-[#004D40] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.9-.32-1.98-.23-2.81.33-.85.51-1.33 1.43-1.42 2.41-.02.41-.01.82.04 1.22.14 1.02.73 1.93 1.56 2.52.88.63 2.05.8 3.09.43.95-.31 1.7-1.07 2.03-2.01.24-.62.33-1.3.31-1.96V.02z"/></svg>
                    </a>
                    <a href="https://www.facebook.com/bimbelinaja.sda" target="_blank" class="group flex items-center justify-center w-10 h-10 rounded-2xl bg-white/5 border border-white/10 hover:bg-[#FFC107] hover:border-[#FFC107] transition-all duration-500 shadow-xl">
                        <svg class="w-5 h-5 text-teal-50 group-hover:text-[#004D40] transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="pt-10 border-t border-white/5 text-center mt-10">
            <p class="text-teal-100/20 text-[8px] font-black uppercase tracking-[0.5em] italic">© 2026 BimbelinAja | By Mandul Arman & Abdul</p>
        </div>
    </div>
</footer>

{{-- WIDGET WHATSAPP SIGNATURE SYSTEM --}}
<div id="draggable-wa-container" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-[999] flex flex-col items-end" style="touch-action: none;">
    
    {{-- BOX CHAT POPUP --}}
    <div id="wa-chat-box" class="hidden opacity-0 translate-y-10 scale-90 transition-all duration-500 mb-4 w-[280px] md:w-[350px] bg-white rounded-[2rem] md:rounded-[2.5rem] shadow-2xl overflow-hidden border border-gray-100 origin-bottom-right">
        <div class="bg-[#006064] p-4 md:p-6 text-white relative">
            <div class="flex items-center space-x-3 md:space-x-4">
                <div class="relative">
                    <img src="https://ui-avatars.com/api/?name=Admin+BimbelinAja&background=FFC107&color=006064&bold=true" class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl border-2 border-white/20 shadow-lg">
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-400 border-2 border-[#006064] rounded-full animate-pulse"></span>
                </div>
                <div>
                    <h5 class="font-black text-xs md:text-sm uppercase italic tracking-wider">Admin BimbelinAja</h5>
                    <p class="text-[9px] md:text-[10px] text-teal-100 font-bold uppercase italic opacity-80">Online • Siap Membantu</p>
                </div>
            </div>
            <button onclick="toggleWaChat()" class="absolute top-4 right-4 md:top-6 md:right-6 text-white/50 hover:text-white transition-colors">✕</button>
        </div>

        <div class="p-6 md:p-8 bg-[#f0f2f5] space-y-4 max-h-[200px] md:max-h-[250px] overflow-y-auto">
            <div class="bg-white p-3 md:p-4 rounded-xl md:rounded-2xl rounded-tl-none shadow-sm border border-gray-100 max-w-[95%]">
                <p class="text-[12px] md:text-[13px] text-gray-700 font-medium leading-relaxed">
                    Halo! Ada yang bisa kami bantu? 😊
                </p>
            </div>
        </div>

        <div class="p-4 md:p-6 bg-white border-t border-gray-50">
            <a href="https://wa.me/6283102064517?text=Halo%20Admin%20BimbelinAja..." 
               target="_blank" 
               class="flex items-center justify-center space-x-3 bg-[#25D366] text-white font-black py-3 md:py-4 rounded-xl md:rounded-2xl shadow-xl transition-all active:scale-95 uppercase italic text-[9px] md:text-[10px] tracking-widest text-center">
                <span>Chat di WhatsApp</span>
            </a>
        </div>
    </div>

    {{-- TOMBOL UTAMA --}}
    <div id="wa-icon-wrapper" class="cursor-grab active:cursor-grabbing relative animate-entrance">
        <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 border-2 border-white rounded-full flex items-center justify-center text-[9px] font-black italic animate-pulse z-10 text-white">1</span>
        <svg id="icon-wa-svg" class="w-12 h-12 md:w-14 md:h-14 drop-shadow-xl hover:scale-105 transition-transform text-[#25D366]" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </div>
</div>

<style>
    @keyframes entrance { 0% { transform: scale(0) rotate(90deg); opacity: 0; } 100% { transform: scale(1) rotate(0); opacity: 1; } }
    .animate-entrance { animation: entrance 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
</style>

<script>
    // Seluruh logika JavaScript Draggable & Popup tetap dipertahankan
    const container = document.getElementById('draggable-wa-container');
    const wrapper = document.getElementById('wa-icon-wrapper');
    const chatBox = document.getElementById('wa-chat-box');
    let isDragging = false;
    let startX, startY, initialX, initialY;
    let hasMoved = false;

    function toggleWaChat() {
        if (hasMoved) return; 
        if (chatBox.classList.contains('hidden')) {
            chatBox.classList.remove('hidden');
            setTimeout(() => {
                chatBox.classList.remove('opacity-0', 'translate-y-10', 'scale-90');
                chatBox.classList.add('opacity-100', 'translate-y-0', 'scale-100');
            }, 10);
        } else {
            chatBox.classList.add('opacity-0', 'translate-y-10', 'scale-90');
            chatBox.classList.remove('opacity-100', 'translate-y-0', 'scale-100');
            setTimeout(() => chatBox.classList.add('hidden'), 500);
        }
    }

    wrapper.addEventListener('mousedown', startDragging);
    document.addEventListener('mousemove', drag);
    document.addEventListener('mouseup', stopDragging);
    wrapper.addEventListener('touchstart', (e) => startDragging(e.touches[0]), {passive: false});
    document.addEventListener('touchmove', (e) => drag(e.touches[0]), {passive: false});
    document.addEventListener('touchend', stopDragging);

    function startDragging(e) {
        isDragging = true;
        hasMoved = false;
        startX = e.clientX;
        startY = e.clientY;
        const rect = container.getBoundingClientRect();
        initialX = rect.left;
        initialY = rect.top;
    }

    function drag(e) {
        if (!isDragging) return;
        const dx = e.clientX - startX;
        const dy = e.clientY - startY;
        if (Math.abs(dx) > 5 || Math.abs(dy) > 5) hasMoved = true;
        container.style.bottom = 'auto';
        container.style.right = 'auto';
        container.style.left = (initialX + dx) + 'px';
        container.style.top = (initialY + dy) + 'px';
    }

    function stopDragging() {
        if (!isDragging) return;
        isDragging = false;
        if (!hasMoved) toggleWaChat();
    }
</script>