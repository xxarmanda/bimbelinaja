@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto px-4">

    {{-- HEADER --}}
    <div class="mb-12">
        <h1 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">
            Manajemen Konten Website
        </h1>
        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest italic">
            Kelola seluruh teks & gambar landing page
        </p>
    </div>

    {{-- CONTENT LIST --}}
    <div class="space-y-10">

        @forelse($settings->where('section','!=','stats') as $s)

        @php
            // Normalisasi path biar gak error walau format lama
            $imagePath = $s->image;

            if($imagePath){
                $imagePath = str_replace('uploads/les_online/online_page/', 'uploads/online_page/', $imagePath);
                $imagePath = str_replace('les_online/online_page/', 'uploads/online_page/', $imagePath);
                $imagePath = str_replace('online_page/online_page/', 'online_page/', $imagePath);
            }
        @endphp

        <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100">

            {{-- LABEL --}}
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h3 class="text-lg font-black text-[#006064] uppercase italic tracking-tight">
                        {{ strtoupper(str_replace('_',' ',$s->section)) }}
                    </h3>
                    <p class="text-[10px] text-gray-400 font-bold italic">
                        Konten Section Landing Page
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.online-settings.update',$s->id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid lg:grid-cols-3 gap-10">

                    {{-- TEXT --}}
                    <div class="lg:col-span-2 space-y-6">

                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">
                                Judul
                            </label>
                            <input type="text" name="title"
                                   value="{{ old('title',$s->title) }}"
                                   class="w-full bg-gray-50 border border-gray-200 rounded-xl px-6 py-4 text-sm font-bold text-[#006064] focus:ring-2 focus:ring-[#FFC107] outline-none">
                        </div>

                        <div>
                            <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 block">
                                Deskripsi
                            </label>
                            <textarea name="description" rows="5"
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-6 py-4 text-sm text-gray-700 leading-relaxed focus:ring-2 focus:ring-[#FFC107] outline-none">{{ old('description',$s->description) }}</textarea>
                        </div>

                    </div>

                    {{-- IMAGE --}}
                    <div class="space-y-5">

                        <label class="text-[10px] font-black text-gray-400 uppercase tracking-widest block">
                            Gambar Section
                        </label>

                        {{-- IMAGE PREVIEW --}}
                        <div class="w-36 h-36 bg-gray-50 rounded-2xl border border-gray-200 shadow flex items-center justify-center overflow-hidden">
                            @if($imagePath)
                                <img src="{{ asset($imagePath) }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-3xl text-gray-300">🖼️</span>
                            @endif
                        </div>

                        <input type="file" name="image"
                               class="w-full text-[11px] text-gray-500 file:bg-[#006064] file:text-white file:border-0 file:px-5 file:py-2 file:rounded-xl file:font-black cursor-pointer">

                        <p class="text-[10px] text-gray-400 italic">
                            JPG / PNG / SVG • Maks 2MB
                        </p>

                        <button type="submit"
                                class="w-full bg-[#FFC107] text-[#006064] font-black py-4 rounded-xl shadow-lg hover:bg-yellow-500 transition uppercase tracking-widest text-[10px] italic">
                            Simpan Perubahan
                        </button>

                    </div>

                </div>
            </form>

        </div>

        @empty

        <div class="bg-white p-16 rounded-3xl text-center border border-dashed border-gray-300">
            <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4">
                DATA BELUM TERSEDIA
            </p>
            <code class="bg-gray-100 px-4 py-2 rounded-lg text-[#006064] font-bold text-[11px]">
                php artisan db:seed
            </code>
        </div>

        @endforelse

    </div>

</div>

@endsection