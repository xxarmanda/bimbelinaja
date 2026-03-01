@extends('layouts.admin')

@section('content')
<div class="max-w-full mx-auto pb-20">

    {{-- BAGIAN 1: PENGATURAN TEKS UTAMA --}}
    <div class="mb-14">
        <div class="mb-8">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                Pengaturan Teks Seksi Pendaftaran
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-3">
                Ubah judul utama & deskripsi yang tampil di landing page
            </p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-12">
            <form action="{{ route('admin.registration.settings.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                    {{-- Judul Seksi --}}
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Judul Seksi (Hijau)
                        </label>
                        <input type="text" name="registration_title"
                               value="{{ old('registration_title', $settings['registration_title'] ?? 'CARA DAFTAR LES PRIVAT') }}"
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    {{-- Brand --}}
                    <div>
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Nama Brand (Kuning)
                        </label>
                        <input type="text" name="registration_brand"
                               value="{{ old('registration_brand', $settings['registration_brand'] ?? 'BIMBELINAJA') }}"
                               class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">
                    </div>

                    {{-- Subtitle --}}
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-[#006064] uppercase tracking-widest mb-3 italic">
                            Deskripsi / Sub Judul
                        </label>
                        <textarea name="registration_subtitle" rows="3"
                                  class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl px-6 py-4 text-sm font-bold text-gray-700 focus:border-teal-500 focus:bg-white transition-all outline-none">{{ old('registration_subtitle', $settings['registration_subtitle'] ?? 'Dapatkan tutor profesional sesuai kebutuhan Anda melalui proses pendaftaran yang praktis, cepat, dan tanpa ribet.') }}</textarea>
                    </div>

                </div>

                <div class="mt-10 flex justify-end">
                    <button type="submit"
                            class="bg-yellow-400 hover:bg-yellow-500 text-[#006064] px-12 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all shadow-lg shadow-yellow-500/20">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <hr class="border-gray-100 mb-14">

    {{-- BAGIAN 2: DAFTAR LANGKAH PENDAFTARAN --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">
                Daftar Kartu Langkah
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-3">
                Kelola ikon dan isi setiap langkah pendaftaran
            </p>
        </div>

        <a href="{{ route('admin.registration-steps.create') }}"
           class="bg-[#006064] hover:bg-teal-900 text-white px-8 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest transition-all shadow-lg shadow-teal-900/20 inline-flex items-center gap-2">
            <span class="text-lg leading-none">+</span> Tambah Kartu Baru
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="mb-8 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold text-xs rounded-xl">
             {{ session('success') }}
        </div>
    @endif

    {{-- Tabel --}}
    <div class="bg-white rounded-[2.5rem] shadow border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-100">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black text-[#006064] uppercase tracking-widest w-20">Urutan</th>
                        <th class="px-6 py-5 text-[10px] font-black text-[#006064] uppercase tracking-widest w-32">Gambar</th>
                        <th class="px-6 py-5 text-[10px] font-black text-[#006064] uppercase tracking-widest">Judul</th>
                        <th class="px-6 py-5 text-[10px] font-black text-[#006064] uppercase tracking-widest">Deskripsi</th>
                        <th class="px-6 py-5 text-[10px] font-black text-[#006064] uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($steps as $step)
                    <tr class="hover:bg-gray-50/60 transition-all">
                        <td class="px-6 py-5 text-center">
                            <span class="bg-teal-50 text-[#006064] font-black px-4 py-2 rounded-xl text-xs">
                                {{ $step->order }}
                            </span>
                        </td>

                        <td class="px-6 py-5">
                            @if($step->icon && file_exists(public_path($step->icon)))
                                <img src="{{ asset($step->icon) }}" class="w-12 h-12 object-contain">
                            @else
                                <div class="w-12 h-12 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-xl">🖼️</div>
                            @endif
                        </td>

                        <td class="px-6 py-5 font-black text-[#006064] uppercase text-xs italic tracking-tight">
                            {{ $step->title }}
                        </td>

                        <td class="px-6 py-5 text-gray-500 text-xs italic leading-relaxed max-w-xs truncate">
                            {{ $step->description }}
                        </td>

                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.registration-steps.edit',$step->id) }}"
                                   class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-xl text-xs transition-all">
                                    Edit
                                </a>

                                <form action="{{ route('admin.registration-steps.destroy',$step->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Hapus langkah ini?')"
                                            class="px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl text-xs transition-all">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center text-gray-300 font-black uppercase text-xs italic">
                            Belum ada langkah pendaftaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection