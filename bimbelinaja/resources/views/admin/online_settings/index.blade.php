@extends('layouts.admin') {{-- Pastikan file layouts/admin.blade.php kamu sudah benar --}}

@section('content')
{{-- Header Dashboard Utama agar konsisten dengan menu lain --}}
<div class="mb-10">
    <h1 class="text-xl font-black text-[#006064] uppercase tracking-tighter">Dashboard Utama</h1>
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">BimbelinAja Management System</p>
</div>

<div class="mb-12">
    <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter mb-2">Pengaturan Laman Online</h2>
    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest italic">Klik "Ubah Konten" untuk mengelola teks dan visual per bagian.</p>
</div>

{{-- GRID KONTEN GAYA BENTO --}}
<div class="grid gap-6">
    @forelse($settings as $s)
    <div class="bg-white p-8 rounded-[2.5rem] shadow-xl shadow-teal-900/5 border border-gray-50 flex justify-between items-center group hover:translate-x-2 transition-all duration-300">
        <div class="flex items-center space-x-6">
            <div class="w-14 h-14 bg-teal-50 rounded-2xl flex items-center justify-center text-[#006064] group-hover:bg-[#006064] group-hover:text-white transition-colors">
                <span class="font-black text-xs uppercase">{{ substr($s->section, 0, 2) }}</span>
            </div>
            <div>
                <h4 class="text-sm font-black text-[#006064] uppercase italic">{{ str_replace('_', ' ', $s->section) }}</h4>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ Str::limit($s->title, 40) ?? 'Konten belum diatur' }}</p>
            </div>
        </div>
        <a href="{{ route('admin.online-settings.edit', $s->id) }}" 
           class="bg-[#FFC107] text-[#006064] font-black py-3 px-8 rounded-xl text-[10px] uppercase tracking-widest shadow-lg shadow-yellow-500/20 hover:bg-yellow-500 transition-all">
            Ubah Konten 
        </a>
    </div>
    @empty
    {{-- JIKA DATA KOSONG --}}
    <div class="bg-white p-20 rounded-[3rem] text-center border-2 border-dashed border-gray-100">
        <p class="text-[10px] font-black text-gray-300 uppercase tracking-[0.3em] mb-4">Data belum tersedia.</p>
        <code class="bg-gray-50 px-4 py-2 rounded-lg text-[#006064] font-bold text-[10px]">Jalankan: php artisan db:seed</code>
    </div>
    @endforelse
</div>
@endsection