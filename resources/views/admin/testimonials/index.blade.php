<x-admin-layout>
<div class="p-10 bg-[#FBFCFD] min-h-screen">

    {{-- HEADER --}}
    <div class="mb-12">
        <h2 class="text-4xl font-black text-[#006064] uppercase italic tracking-tighter">
            Manajemen <span class="text-yellow-400">Testimoni</span>
        </h2>
        <p class="text-xs text-gray-400 italic mt-2">
            Kelola konten testimoni siswa & pengaturan judul section homepage.
        </p>
    </div>

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-8 p-5 bg-[#006064] text-white rounded-2xl text-xs font-bold shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROR VALIDATION --}}
    @if ($errors->any())
        <div class="mb-8 p-5 bg-red-50 text-red-600 rounded-2xl text-xs font-bold shadow">
            <ul class="list-disc ml-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM PENGATURAN JUDUL --}}
    <div class="bg-white rounded-3xl p-10 shadow mb-16 border">
        <h3 class="font-black text-[#006064] uppercase italic mb-6 tracking-wide">
            Pengaturan Judul Section
        </h3>

        <form action="{{ route('admin.testimonials.updateTitle') }}" method="POST">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Judul</label>
                    <input type="text" name="testimonial_title" value="{{ old('testimonial_title', $testimonial_title) }}" required
                           class="w-full mt-2 p-5 rounded-xl bg-gray-50 font-bold border focus:ring-2 focus:ring-[#006064]">
                </div>

                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Sub Judul</label>
                    <input type="text" name="testimonial_subtitle" value="{{ old('testimonial_subtitle', $testimonial_subtitle) }}" required
                           class="w-full mt-2 p-5 rounded-xl bg-gray-50 font-bold italic border focus:ring-2 focus:ring-[#006064]">
                </div>
            </div>

            <button class="mt-8 bg-yellow-400 px-10 py-4 font-black rounded-xl uppercase text-xs shadow hover:scale-105 transition">
                Update Judul
            </button>
        </form>
    </div>

    {{-- FORM CREATE --}}
    <div class="bg-white rounded-3xl p-10 shadow mb-16 border">
        <h3 class="font-black text-[#006064] uppercase italic mb-6 tracking-wide">
            Tambah Testimoni
        </h3>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Nama Siswa</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama siswa" required
                           class="w-full mt-2 p-5 rounded-xl bg-gray-50 font-bold border">
                </div>

                <div>
                    <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Label / Jenjang</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="SMA / SMK / Alumni" required
                           class="w-full mt-2 p-5 rounded-xl bg-gray-50 font-bold border">
                </div>
            </div>

            <div class="mt-6">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Pesan Testimoni</label>
                <textarea name="testimony" rows="4" required
                          class="w-full mt-2 p-5 rounded-xl bg-gray-50 border"
                          placeholder="Pesan testimoni siswa...">{{ old('testimony') }}</textarea>
            </div>

            <div class="mt-6">
                <label class="text-xs font-bold uppercase tracking-widest text-gray-400">Foto Siswa</label>
                
                <input type="file" 
                    id="fotoSiswa" 
                    name="image" 
                    required 
                    accept=".png, .jpg, .jpeg, .svg"
                    class="block mt-3"
                    onchange="validateFile(this)">
                    
                <p class="text-xs mt-1 text-gray-500">Format yang diperbolehkan: PNG, JPG, atau SVG</p>
            </div>

            <script>
            function validateFile(input) {
                const filePath = input.value;
                // Regex untuk mengecek ekstensi file
                const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.svg)$/i;
                
                if (filePath && !allowedExtensions.exec(filePath)) {
                    alert('File tidak valid! Silakan unggah foto dengan format PNG, JPG, atau SVG.');
                    input.value = ''; // Reset input jika file salah
                    return false;
                }
            }
            </script>

            <button class="mt-8 bg-[#006064] text-white px-12 py-4 rounded-xl font-black uppercase text-xs shadow hover:scale-105 transition">
                Simpan Testimoni
            </button>
        </form>
    </div>

    {{-- LIST TESTIMONI --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($testimonials as $t)
        <div class="bg-white p-6 rounded-3xl shadow border flex flex-col justify-between hover:shadow-lg transition">

            <div>
                <div class="w-full h-48 bg-gray-100 rounded-xl overflow-hidden mb-4">
                    @if($t->image)
                        <img src="{{ asset($t->image) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 text-4xl">📷</div>
                    @endif
                </div>

                <h4 class="font-black text-[#006064] text-lg">{{ $t->name }}</h4>
                <span class="inline-block mt-1 text-[10px] bg-yellow-400 px-3 py-1 rounded-lg font-black uppercase italic">
                    {{ $t->title }}
                </span>

                <p class="text-xs italic text-gray-500 mt-4 leading-relaxed">
                    "{{ Str::limit($t->testimony, 120) }}"
                </p>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.testimonials.edit',$t->id) }}"
                   class="px-5 py-2 bg-blue-500 text-white rounded-xl text-xs font-black uppercase shadow">
                    Edit
                </a>

                <form action="{{ route('admin.testimonials.destroy',$t->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('Hapus testimoni ini?')"
                            class="px-5 py-2 bg-red-500 text-white rounded-xl text-xs font-black uppercase shadow">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
            <div class="col-span-full text-center py-20 text-gray-300 font-black uppercase tracking-widest italic">
                Belum ada data testimoni.
            </div>
        @endforelse
    </div>

</div>
</x-admin-layout>