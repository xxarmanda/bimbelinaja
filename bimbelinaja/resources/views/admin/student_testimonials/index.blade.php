@extends('layouts.admin')

@section('content')
<div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
    {{-- Header Manajemen --}}
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-2xl font-black text-[#006064] uppercase italic tracking-tighter">Manajemen Testimoni Siswa</h2>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.2em] mt-1">Daftar feedback dari siswa BimbelinAja untuk halaman Beranda</p>
        </div>
        <a href="{{ route('admin.student-testimonials.create') }}" class="bg-[#006064] hover:bg-teal-900 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest transition shadow-lg shadow-teal-900/20 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
            Tambah Testimoni
        </a>
    </div>

    {{-- Pesan Sukses --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-teal-50 border-l-4 border-teal-500 text-teal-700 text-xs font-bold uppercase tracking-widest rounded-r-xl">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Testimoni --}}
    <div class="overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-y-3">
            <thead>
                <tr class="text-[10px] uppercase tracking-[0.3em] text-gray-400">
                    <th class="px-6 pb-4">No</th>
                    <th class="px-6 pb-4">Siswa (Media)</th>
                    <th class="px-6 pb-4">Pesan Testimoni</th>
                    <th class="px-6 pb-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($testimonials as $index => $testi)
                <tr class="group">
                    <td class="bg-gray-50/50 px-6 py-4 rounded-l-3xl font-black text-[#006064]">{{ $index + 1 }}</td>
                    <td class="bg-gray-50/50 px-6 py-4">
                        <div class="flex items-center space-x-4">
                            
                            {{-- LOGIKA TAMPILAN MEDIA (VIDEO / FOTO / DEFAULT) --}}
                            <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-md border-2 border-white flex-shrink-0 relative">
                                @if($testi->youtube_id)
                                    {{-- TAMPILAN 1: Jika Menggunakan Youtube --}}
                                    <div class="w-full h-full bg-red-50 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                                        </svg>
                                    </div>
                                @elseif($testi->image)
                                    {{-- TAMPILAN 2: Jika Menggunakan Foto Upload --}}
                                    <img src="{{ asset('storage/' . $testi->image) }}" class="w-full h-full object-cover">
                                @else
                                    {{-- TAMPILAN 3: Default (Inisial Nama) --}}
                                    <div class="w-full h-full bg-[#006064] flex items-center justify-center text-white font-black text-xl">
                                        {{ substr($testi->name, 0, 1) }}
                                    </div>
                                @endif
                            </div>

                            {{-- Nama & Title --}}
                            <div>
                                <p class="font-black text-gray-800 uppercase tracking-tighter leading-none mb-1">{{ $testi->name }}</p>
                                <p class="text-[9px] text-teal-600 font-bold uppercase italic">{{ $testi->title }}</p>
                                {{-- Label Kecil Tipe Media --}}
                                @if($testi->youtube_id)
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-red-100 text-red-600 rounded-md text-[8px] font-bold uppercase tracking-wider">Video</span>
                                @elseif($testi->image)
                                    <span class="inline-block mt-1 px-2 py-0.5 bg-blue-100 text-blue-600 rounded-md text-[8px] font-bold uppercase tracking-wider">Foto</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="bg-gray-50/50 px-6 py-4 text-gray-500 italic text-xs leading-relaxed max-w-xs">
                        "{{ Str::limit($testi->message, 100) }}"
                    </td>
                    <td class="bg-gray-50/50 px-6 py-4 rounded-r-3xl text-center">
                        <div class="flex justify-center items-center space-x-3">
                            {{-- Tombol Edit --}}
                            <a href="{{ route('admin.student-testimonials.edit', $testi->id) }}" class="p-2 bg-white text-yellow-500 rounded-xl shadow-sm hover:bg-yellow-500 hover:text-white transition-all border border-yellow-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </a>
                            {{-- Tombol Hapus --}}
                            <form action="{{ route('admin.student-testimonials.destroy', $testi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 bg-white text-red-400 rounded-xl shadow-sm hover:bg-red-400 hover:text-white transition-all border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-20 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                            <p class="font-black uppercase tracking-[0.4em] text-xs">Belum ada testimoni siswa</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection