@extends('layouts.admin')

@section('content')
<div class="max-w-full mx-auto pb-20">
    {{-- BAGIAN 1: PENGATURAN VISI (Teks Tunggal) --}}
    <div class="mb-12">
        <div class="mb-6">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                Pengaturan Visi
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
                Satu kalimat utama yang menggambarkan cita-cita BimbelinAja
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
            <form action="{{ route('admin.settings.video.update') }}" method="POST">
                @csrf @method('PATCH')
                
                <div>
                    <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-4 italic">Kalimat Visi (Kotak Hijau di Landing Page)</label>
                    <textarea name="vision_text" rows="3" 
                              class="w-full bg-gray-50 border-2 border-gray-100 rounded-[2rem] px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 outline-none transition-all">{{ $settings['vision_text'] ?? 'Menjadi platform pendidikan privat nomor satu yang mampu mencetak lulusan kompeten, kreatif, dan berdaya saing global.' }}</textarea>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="bg-yellow-400 text-[#006064] px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-500/20">
                        Simpan Visi 
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="border-gray-100 mb-12">

    {{-- BAGIAN 2: KELOLA POIN MISI (CRUD) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- Form Tambah Misi --}}
        <div class="lg:col-span-1">
            <div class="mb-6">
                <h2 class="text-2xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">Tambah Misi</h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Langkah strategis BimbelinAja</p>
            </div>

            <form action="{{ route('admin.missions.store') }}" method="POST" class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2 italic">Judul Misi</label>
                    <input type="text" name="title" required placeholder="Contoh: TUTOR BERKUALITAS" 
                           class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2 italic">Deskripsi Misi</label>
                    <textarea name="description" required placeholder="Jelaskan detail misinya..." 
                              class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none h-32"></textarea>
                </div>
                <button type="submit" class="w-full bg-[#006064] text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-[10px] hover:bg-teal-900 transition-all">
                    Tambah Poin Misi 
                </button>
            </form>
        </div>

        {{-- Tabel Daftar Misi --}}
        <div class="lg:col-span-2">
            <div class="mb-6">
                <h2 class="text-2xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">Daftar Misi Strategis</h2>
                <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">Daftar poin yang muncul di bawah Visi</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Misi</th>
                            <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($missions as $m)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <h4 class="font-black text-[#006064] text-xs uppercase italic mb-1">{{ $m->title }}</h4>
                                <p class="text-gray-400 text-[10px] italic font-bold leading-relaxed">{{ $m->description }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <form action="{{ route('admin.missions.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus misi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-red-50 text-red-500 p-3 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="px-8 py-20 text-center text-gray-300 font-black uppercase text-xs italic">
                                Belum ada poin misi strategis.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection