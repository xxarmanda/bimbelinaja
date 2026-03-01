<x-admin-layout>
    <x-slot name="header">Pusat Kendali Sistem</x-slot>

    <div class="space-y-10 pb-10">
        
        {{-- 1. WELCOME SECTION --}}
        <div class="bg-white p-10 md:p-14 rounded-[4rem] shadow-sm border border-gray-100 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-80 h-80 bg-teal-50 rounded-bl-full -z-0 opacity-50 group-hover:scale-110 transition-transform duration-1000"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-12">
                <div class="relative">
                    <div class="w-28 h-28 bg-[#FFC107] rounded-[2.5rem] flex items-center justify-center text-[#006064] shadow-2xl shadow-yellow-500/40 rotate-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="absolute -bottom-2 -right-2 bg-green-500 w-8 h-8 rounded-full border-4 border-white animate-pulse"></span>
                </div>
                
                <div class="text-center md:text-left space-y-4">
                    <h2 class="text-4xl md:text-5xl font-black text-[#006064] uppercase tracking-tighter italic leading-none">
                        Halo, <span class="text-teal-500">{{ explode(' ', Auth::user()->name)[0] }}!</span>
                    </h2>
                    <p class="text-gray-400 font-bold italic text-sm leading-relaxed border-l-4 border-[#FFC107] pl-6 py-1 max-w-2xl">
                        Panel kendali <span class="text-[#006064]">BimbelinAja</span> aktif. Kamu memiliki kendali penuh atas kurikulum, tutor, wilayah Ciayumajakuning, hingga verifikasi pembayaran siswa.
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. MAIN STATS (REGISTRASI & PESAN) --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Verifikasi Bayar (Transactions) --}}
            <div class="bg-[#006064] p-10 rounded-[3.5rem] text-white shadow-2xl shadow-teal-900/20 relative overflow-hidden group">
                <div class="absolute -right-4 -bottom-4 text-white/5 group-hover:scale-110 transition-transform">
                    <svg class="w-40 h-40" fill="currentColor" viewBox="0 0 24 24"><path d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-teal-200 italic mb-2">Keuangan & Registrasi</p>
                <h3 class="text-5xl font-black italic tracking-tighter">{{ \App\Models\Transaction::count() }}</h3>
                <p class="text-xs font-bold mt-4 text-teal-100 italic">Siswa Terdaftar di Sistem</p>
                <a href="{{ route('admin.transactions.index') }}" class="inline-block mt-8 text-[9px] font-black uppercase tracking-widest bg-[#FFC107] text-[#006064] px-6 py-3 rounded-xl hover:bg-white transition-colors">Cek Pendaftaran →</a>
            </div>

            {{-- Pesan Masuk (Contact Messages) --}}
            <div class="bg-white p-10 rounded-[3.5rem] border border-gray-100 shadow-sm relative overflow-hidden group">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 italic mb-2">Support & Inbox</p>
                <h3 class="text-5xl font-black text-[#006064] italic tracking-tighter">{{ \App\Models\ContactMessage::count() }}</h3>
                <p class="text-xs font-bold mt-4 text-gray-400 italic">Pesan dari Calon Siswa</p>
                <a href="{{ route('admin.messages.index') }}" class="inline-block mt-8 text-[9px] font-black uppercase tracking-widest border border-gray-100 text-gray-400 hover:text-[#006064] px-6 py-3 rounded-xl transition-all">Buka Inbox</a>
            </div>

            {{-- Kelola Tutor (Tutors) --}}
            <div class="bg-white p-10 rounded-[3.5rem] border border-gray-100 shadow-sm relative overflow-hidden group">
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-300 italic mb-2">Tenaga Pengajar</p>
                <h3 class="text-5xl font-black text-[#006064] italic tracking-tighter">{{ \App\Models\Tutor::count() }}</h3>
                <p class="text-xs font-bold mt-4 text-gray-400 italic">Tutor Aktif Terdaftar</p>
                <a href="{{ route('admin.tutors.index') }}" class="inline-block mt-8 text-[9px] font-black uppercase tracking-widest border border-gray-100 text-gray-400 hover:text-[#006064] px-6 py-3 rounded-xl transition-all">Manajemen Tutor</a>
            </div>
        </div>

        {{-- 3. CONTENT & MASTER DATA GRID --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            {{-- Jenjang --}}
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-50 text-center hover:-translate-y-2 transition-all">
                <p class="text-[9px] font-black text-gray-300 uppercase italic mb-1">Jenjang</p>
                <h4 class="text-2xl font-black text-[#006064] italic">{{ \App\Models\Program::count() }}</h4>
            </div>
            {{-- Mapel --}}
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-50 text-center hover:-translate-y-2 transition-all">
                <p class="text-[9px] font-black text-gray-300 uppercase italic mb-1">Mata Pelajaran</p>
                <h4 class="text-2xl font-black text-[#006064] italic">{{ \App\Models\SubProgram::count() }}</h4>
            </div>
            {{-- Wilayah --}}
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-50 text-center hover:-translate-y-2 transition-all">
                <p class="text-[9px] font-black text-gray-300 uppercase italic mb-1">Wilayah</p>
                <h4 class="text-2xl font-black text-[#006064] italic">{{ \App\Models\ServiceArea::count() }}</h4>
            </div>
            {{-- Media --}}
            <div class="bg-white p-6 rounded-[2.5rem] border border-gray-50 text-center hover:-translate-y-2 transition-all">
                <p class="text-[9px] font-black text-gray-300 uppercase italic mb-1">Liputan Media</p>
                <h4 class="text-2xl font-black text-[#006064] italic">{{ \App\Models\MediaCoverage::count() }}</h4>
            </div>
        </div>

        {{-- 4. VISUAL & SOCIAL PROOF SECTION --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Testimoni Block --}}
            <div class="bg-gray-50 p-8 rounded-[3.5rem] flex items-center justify-between group">
                <div class="space-y-1">
                    <h5 class="text-[#006064] font-black uppercase italic text-sm tracking-tighter">Social Proof</h5>
                    <p class="text-[10px] text-gray-400 font-bold uppercase italic">Testimoni Karir & Siswa</p>
                </div>
                <div class="flex -space-x-4">
                    <div class="w-12 h-12 bg-[#FFC107] rounded-full border-4 border-white flex items-center justify-center font-black text-[10px] text-[#006064] z-20">
                        {{ \App\Models\Testimonial::count() }}
                    </div>
                    <div class="w-12 h-12 bg-teal-500 rounded-full border-4 border-white flex items-center justify-center font-black text-[10px] text-white z-10">
                        {{ \App\Models\StudentTestimonial::count() }}
                    </div>
                </div>
            </div>

            {{-- Slider & Assets --}}
            <div class="bg-gray-50 p-8 rounded-[3.5rem] flex items-center justify-between group">
                <div class="space-y-1">
                    <h5 class="text-[#006064] font-black uppercase italic text-sm tracking-tighter">Visual Assets</h5>
                    <p class="text-[10px] text-gray-400 font-bold uppercase italic">Slider & Visi Misi</p>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-2xl font-black text-gray-200 italic group-hover:text-[#FFC107] transition-colors">
                        {{ \App\Models\Slider::count() + \App\Models\Mission::count() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-admin-layout>