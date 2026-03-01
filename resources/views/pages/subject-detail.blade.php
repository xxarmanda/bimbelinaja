@extends('layouts.app') {{-- Gunakan layout utama kamu --}}

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="max-w-5xl mx-auto px-6">
        
        {{-- HEADER: GAMBAR & JUDUL --}}
        <div class="bg-white rounded-[3rem] overflow-hidden shadow-2xl shadow-teal-900/5 border border-gray-100 mb-10">
            <div class="grid md:grid-cols-2">
                <div class="h-64 md:h-auto overflow-hidden">
                    @if($subProgram->image)
                        <img src="{{ asset('storage/' . $subProgram->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-teal-100 flex items-center justify-center text-6xl">📚</div>
                    @endif
                </div>
                <div class="p-10 flex flex-col justify-center">
                    <span class="text-[10px] font-black uppercase tracking-[0.4em] text-teal-500 mb-2">Mata Pelajaran</span>
                    <h1 class="text-4xl font-black text-[#006064] uppercase tracking-tighter italic leading-none mb-4">
                        {{ $subProgram->name }}
                    </h1>
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="bg-[#FFC107] text-[#006064] px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest">
                            Rp {{ number_format($subProgram->price, 0, ',', '.') }}
                        </span>
                        <span class="text-gray-400 text-[10px] font-bold uppercase tracking-widest italic">Akses Selamanya</span>
                    </div>
                    <p class="text-gray-500 font-medium leading-relaxed italic">
                        {{ $subProgram->description }}
                    </p>
                </div>
            </div>
        </div>

        {{-- BAGIAN ACTION: KUIS & BELI --}}
        <div class="grid md:grid-cols-3 gap-8">
            
            {{-- KIRI: KUIS GRATIS --}}
            <div class="md:col-span-2 bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-50">
                <h3 class="text-[#006064] font-black uppercase tracking-widest text-sm mb-6 flex items-center">
                    <span class="w-8 h-1 bg-[#FFC107] mr-3 rounded-full"></span> Coba Kuis Gratis
                </h3>
                <p class="text-gray-400 text-xs font-bold uppercase mb-8 leading-relaxed">
                    Tes kemampuanmu sebelum bergabung! Klik tombol di bawah untuk mencoba kuis singkat mata pelajaran ini.
                </p>
                
                @if($subProgram->quiz_content)
                    <button class="bg-[#006064] text-white px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-teal-900 transition-all shadow-lg shadow-teal-900/20">
                        Mulai Kuis Trial
                    </button>
                @else
                    <div class="p-4 bg-gray-50 rounded-xl border border-dashed border-gray-200 text-center">
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest italic">Kuis trial belum tersedia</p>
                    </div>
                @endif
            </div>

            {{-- KANAN: HARGA & CHECKOUT --}}
            <div class="bg-[#006064] p-10 rounded-[2.5rem] text-white shadow-2xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/5 rounded-full -mr-10 -mt-10"></div>
                <h3 class="text-[#FFC107] font-black uppercase tracking-[0.3em] text-[10px] mb-6">Daftar Sekarang</h3>
                <p class="text-teal-100/70 text-xs font-medium mb-8 leading-relaxed italic">
                    Dapatkan akses materi video, bank soal lengkap, dan bimbingan tutor.
                </p>
                
                <a href="{{ route('checkout', $subProgram->id) }}" class="block text-center bg-[#FFC107] text-[#006064] px-6 py-4 rounded-2xl font-black uppercase tracking-widest text-[10px] hover:bg-yellow-400 transition-all shadow-xl">
                    Beli Program Ini
                </a>
                
                <p class="text-center text-[8px] text-teal-200/40 font-bold uppercase tracking-widest mt-6 italic">
                    *Verifikasi cepat dalam 1x24 jam
                </p>
            </div>

        </div>

    </div>
</div>
@endsection