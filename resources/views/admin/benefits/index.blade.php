@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto pb-20">
    
    {{-- BAGIAN 1: PENGATURAN TEKS UTAMA HALAMAN KARIR --}}
    <div class="mb-16">
        <div class="mb-8">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
                Pengaturan Identitas Karir
            </h2>
            <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
                Ubah Slogan dan Pesan Karir
            </p>
        </div>

        <form action="{{ route('admin.settings.video.update') }}" method="POST" 
              class="bg-white p-10 rounded-[3rem] shadow-sm border border-gray-100">
            @csrf
            @method('PATCH')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                {{-- SLOGAN --}}
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-3 italic">
                        Slogan (Banner Atas)
                    </label>
                    <input type="text" name="career_slogan"
                        value="{{ $settings['career_slogan'] ?? 'BERGABUNG DENGAN EKOSISTEM PENGAJAR TERBAIK' }}"
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none">
                </div>

                {{-- JUDUL KEUNTUNGAN --}}
                <div>
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-3 italic">
                        Judul Keuntungan (Hijau)
                    </label>
                    <input type="text" name="career_benefit_title"
                        value="{{ $settings['career_benefit_title'] ?? 'KEUNTUNGAN MENJADI' }}"
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none">
                </div>

                {{-- BRAND KEUNTUNGAN --}}
                <div>
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-3 italic">
                        Brand Keuntungan (Kuning)
                    </label>
                    <input type="text" name="career_benefit_brand"
                        value="{{ $settings['career_benefit_brand'] ?? 'TUTOR BIMBELINAJA' }}"
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none">
                </div>

                {{-- SUBTITLE --}}
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-[#006064] uppercase mb-3 italic">
                        Sub-judul / Pesan Karir
                    </label>
                    <textarea name="career_benefit_subtitle" rows="2"
                        class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-teal-500 outline-none">{{ $settings['career_benefit_subtitle'] ?? 'Bukan hanya pekerjaan, tapi perjalanan pengembangan diri.' }}</textarea>
                </div>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit"
                    class="bg-yellow-400 text-[#006064] px-10 py-4 rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-yellow-500 transition-all shadow-lg shadow-yellow-500/20">
                    Simpan Teks Karir
                </button>
            </div>
        </form>
    </div>

    <hr class="border-gray-100 mb-16">

    {{-- BAGIAN 2: KELOLA KEUNTUNGAN --}}
    <div class="mb-10">
        <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter leading-none">
            Kelola Butir Keuntungan Tutor
        </h2>
        <p class="text-gray-400 font-bold text-[10px] uppercase tracking-widest mt-2">
            Daftar kartu keuntungan yang muncul di bawah judul
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 font-bold text-[10px] uppercase tracking-widest rounded-r-2xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        {{-- FORM TAMBAH --}}
        <div class="lg:col-span-1">
            <form action="{{ route('admin.benefits.store') }}" method="POST" 
                  enctype="multipart/form-data"
                  class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6 sticky top-28">
                @csrf

                <input type="text" name="title" required
                    placeholder="Contoh: Fleksibel Waktu"
                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm">

                <textarea name="description" required
                    placeholder="Jelaskan secara singkat..."
                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm h-32"></textarea>

                <input type="file" name="image" required
                    class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-3 text-xs">

                <button type="submit"
                    class="w-full bg-[#006064] text-white font-black py-4 rounded-2xl shadow-lg uppercase tracking-widest text-[10px] hover:bg-teal-900 transition-all">
                    Tambah Keuntungan Baru
                </button>
            </form>
        </div>

        {{-- LIST DATA --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase">Ikon</th>
                            <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase">Judul & Deskripsi</th>
                            <th class="px-8 py-6 text-[10px] font-black text-[#006064] uppercase text-right">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse($benefits as $b)
                        <tr class="hover:bg-gray-50/50 transition-colors">

                            <td class="px-8 py-6">
                               @if(!empty($b->image) && file_exists(public_path('uploads/'.$b->image)))
                                <img src="{{ asset('uploads/'.$b->image) }}"  class="w-32 h-32 rounded-2xl object-cover bg-teal-50 border border-teal-100">
                            @else
                                <div class="w-32 h-32 bg-gray-100 rounded-2xl flex items-center justify-center text-xs font-black text-gray-400">No Image</div>
                            @endif
                            </td>

                            <td class="px-8 py-6">
                                <h4 class="font-black text-[#006064] text-sm uppercase mb-1">
                                    {{ $b->title }}
                                </h4>
                                <p class="text-gray-400 text-xs italic font-bold">
                                    "{{ $b->description }}"
                                </p>
                            </td>

                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end space-x-3">

                                    <a href="{{ route('admin.benefits.edit', $b->id) }}"
                                       class="bg-teal-50 text-teal-600 px-4 py-2 rounded-xl text-xs font-bold hover:bg-teal-600 hover:text-white">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.benefits.destroy', $b->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus keuntungan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-50 text-red-500 px-4 py-2 rounded-xl text-xs font-bold hover:bg-red-500 hover:text-white">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-20 text-center text-gray-300 font-black uppercase text-xs">
                                Belum ada data keuntungan.
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