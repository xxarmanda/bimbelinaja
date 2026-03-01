@extends('layouts.admin')

@section('content')
<div class="max-w-full mx-auto pb-20">
    {{-- BAGIAN 1: PENGATURAN TEKS UTAMA (DINAMIS) --}}
    <div class="mb-12">
        <div class="mb-6">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                Pengaturan Teks Seksi Pendaftaran
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
                Ubah Judul Besar & Deskripsi yang muncul di Landing Page
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
            <form action="{{ route('admin.settings.video.update') }}" method="POST"> {{-- Menggunakan route update yang sudah ada di web.php --}}
                @csrf
                @method('PATCH')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Judul Utama --}}
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Judul Seksi (Warna Hijau)</label>
                        <input type="text" name="registration_title" 
                               value="{{ $settings['registration_title'] ?? 'CARA DAFTAR LES PRIVAT' }}" 
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 outline-none transition-all">
                    </div>

                    {{-- Nama Brand --}}
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Nama Brand (Warna Kuning)</label>
                        <input type="text" name="registration_brand" 
                               value="{{ $settings['registration_brand'] ?? 'BIMBELINAJA' }}" 
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 outline-none transition-all">
                    </div>

                    {{-- Sub-judul / Deskripsi --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">Deskripsi / Sub-judul</label>
                        <textarea name="registration_subtitle" rows="2" 
                                  class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 outline-none transition-all">{{ $settings['registration_subtitle'] ?? 'Dapatkan tutor profesional sesuai kebutuhanmu dengan proses pendaftaran yang semudah 1... 2... 3... tanpa ribet.' }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-yellow-400 text-[#006064] px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-500/20">
                        Simpan Perubahan Teks
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="border-gray-100 mb-12">

    {{-- BAGIAN 2: KELOLA KARTU LANGKAH (KODE LAMA KAMU) --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                Daftar Kartu Langkah
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
                Kelola ikon dan isi setiap kartu pendaftaran
            </p>
        </div>
        <a href="{{ route('admin.registration-steps.create') }}" 
           class="bg-[#006064] text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-teal-900 transition-all shadow-lg shadow-teal-900/20 inline-flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
            Tambah Kartu Baru
        </a>
    </div>

    {{-- Alert Notifikasi --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold text-[10px] uppercase tracking-widest rounded-r-2xl shadow-sm">
            ✨ {{ session('success') }}
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest w-20">Urutan</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest w-32">Ikon</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Judul</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest">Deskripsi Kartu</th>
                        <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($steps as $step)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6 text-center">
                                <span class="bg-teal-50 text-[#006064] font-black px-4 py-2 rounded-xl text-xs">{{ $step->order }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="w-12 h-12 bg-gray-50 rounded-xl p-2 border border-gray-100">
                                    <img src="{{ asset('storage/' . $step->icon) }}" class="w-full h-full object-contain">
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="font-black text-[#006064] text-xs uppercase italic tracking-tight">{{ $step->title }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-gray-400 text-[10px] font-bold italic leading-relaxed max-w-xs truncate">{{ $step->description }}</p>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.registration-steps.edit', $step->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.registration-steps.destroy', $step->id) }}" method="POST" onsubmit="return confirm('Hapus langkah ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-8 py-20 text-center text-gray-300 font-black uppercase text-xs italic">Belum ada kartu langkah pendaftaran.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection