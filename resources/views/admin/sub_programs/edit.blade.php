<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- HEADER --}}
        <div class="flex justify-between items-end">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic">Edit Mata Pelajaran</h2>
                <p class="text-gray-500 mt-1 font-medium italic uppercase text-[10px] tracking-widest">Perbarui data pelajaran, manfaat, dan kuis secara real-time.</p>
            </div>
            <a href="{{ route('admin.sub_programs.index') }}" class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-[#006064] transition-colors">
                ← Kembali ke Daftar
            </a>
        </div>

        {{-- FORM UTAMA --}}
        {{-- PERBAIKAN: Mengubah tanda hubung menjadi garis bawah pada rute --}}
        <form action="{{ route('admin.sub_programs.update', $subProgram->id) }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-[3.5rem] p-12 shadow-2xl shadow-teal-900/5 border border-gray-50 relative overflow-hidden">
            @csrf
            @method('PUT')

            {{-- Aksentusi Kuning --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FFC107]/5 rounded-bl-full"></div>

            <div class="space-y-12 relative z-10">
                
                {{-- SECTION 1: INFORMASI DASAR --}}
                <div class="grid md:grid-cols-2 gap-10">
                    {{-- Nama --}}
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-teal-600 uppercase tracking-widest italic ml-2">Nama Mata Pelajaran</label>
                        <input type="text" name="name" value="{{ old('name', $subProgram->name) }}" required
                               class="w-full p-6 rounded-[2rem] bg-gray-50/50 border-none focus:ring-2 focus:ring-[#FFC107] font-bold text-[#006064] shadow-inner outline-none">
                    </div>

                    {{-- Jenjang --}}
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-teal-600 uppercase tracking-widest italic ml-2">Pilih Jenjang Program</label>
                        <select name="program_id" required 
                                class="w-full p-6 rounded-[2rem] bg-gray-50/50 border-none focus:ring-2 focus:ring-[#FFC107] font-black text-[#006064] shadow-inner outline-none cursor-pointer">
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ $subProgram->program_id == $program->id ? 'selected' : '' }}>
                                    {{ strtoupper($program->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Harga & Deskripsi --}}
                <div class="grid md:grid-cols-3 gap-10">
                    <div class="space-y-3">
                        <label class="block text-[10px] font-black text-teal-600 uppercase tracking-widest italic ml-2">Harga (Rp)</label>
                        <input type="number" name="price" value="{{ $subProgram->price }}" required
                               class="w-full p-6 rounded-[2rem] bg-gray-50/50 border-none focus:ring-2 focus:ring-[#FFC107] font-black text-[#006064] shadow-inner outline-none">
                    </div>
                    <div class="md:col-span-2 space-y-3">
                        <label class="block text-[10px] font-black text-teal-600 uppercase tracking-widest italic ml-2">Deskripsi Singkat</label>
                        <textarea name="description" rows="1"
                                  class="w-full p-6 rounded-[2rem] bg-gray-50/50 border-none focus:ring-2 focus:ring-[#FFC107] font-medium text-gray-600 shadow-inner outline-none">{{ old('description', $subProgram->description) }}</textarea>
                    </div>
                </div>

                {{-- SECTION 2: MEDIA --}}
                <div class="p-8 bg-gray-50/30 rounded-[2.5rem] border border-gray-100 flex flex-col md:flex-row items-center gap-8">
                    <div class="w-32 h-32 bg-white rounded-3xl overflow-hidden shadow-lg border-4 border-white">
                        @if($subProgram->image && file_exists(public_path($subProgram->image)))
                            <img src="{{ asset($subProgram->image) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-3xl">🖼️</div>
                        @endif
                    </div>
                    <div class="flex-1 space-y-4">
                        <label class="block text-[10px] font-black text-teal-600 uppercase tracking-widest italic">Ganti Sampul Mata Pelajaran</label>
                        <input type="file" name="image" accept="image/*" 
                               class="text-[10px] text-gray-400 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-900 cursor-pointer">
                        <div class="space-y-1">
                            <p class="text-[9px] text-black font-black uppercase tracking-widest italic">* Format: JPG, PNG, JPEG (Maks 2MB)</p>
                            <p class="text-[9px] text-red-600 font-black uppercase tracking-widest italic">🚫 Dilarang Upload Dokumen/PDF</p>
                        </div>
                    </div>
                </div>

                {{-- SECTION 3: DATA TERKAIT (LEVEL & MANFAAT) --}}
                <div class="grid md:grid-cols-2 gap-10 pt-10 border-t border-gray-100">
                    {{-- Kartu Level --}}
                    <div class="space-y-6">
                        <h3 class="font-black text-[#006064] uppercase text-xs italic tracking-[0.2em]">Kartu Level Aktif</h3>
                        <div class="space-y-4">
                            @forelse($subProgram->items as $item)
                                <div class="bg-white p-5 rounded-2xl border border-gray-100 flex justify-between items-center shadow-sm">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600 font-bold text-xs">{{ substr($item->name, 0, 1) }}</div>
                                        <div>
                                            <p class="text-xs font-black text-[#006064] uppercase italic">{{ $item->name }}</p>
                                            <p class="text-[9px] text-gray-400 font-bold uppercase">{{ $item->age_range }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-[9px] font-bold text-gray-300 uppercase italic">Belum ada kartu level.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- Manfaat --}}
                    <div class="space-y-6">
                        <h3 class="font-black text-[#FFC107] uppercase text-xs italic tracking-[0.2em]">Manfaat Pelajaran</h3>
                        <div class="space-y-4">
                            @forelse($subProgram->benefits as $benefit)
                                <div class="bg-amber-50/50 p-5 rounded-2xl border border-amber-100 flex justify-between items-center">
                                    <div class="flex-1 pr-4">
                                        <p class="text-xs font-black text-amber-700 uppercase italic">{{ $benefit->title }}</p>
                                        <p class="text-[9px] text-amber-600/70 font-medium italic">{{ Str::limit($benefit->description, 50) }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-[9px] font-bold text-gray-300 uppercase italic">Belum ada data manfaat.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- SECTION 4: KUIS --}}
                @if($subProgram->questions->count())
                <div class="bg-teal-900 rounded-[2.5rem] p-10 space-y-8">
                    <div class="flex items-center gap-3">
                        <span class="text-2xl">📝</span>
                        <h3 class="text-lg font-black text-white uppercase italic tracking-tighter">Bank Soal Kuis</h3>
                    </div>

                    <div class="grid gap-6">
                        @foreach($subProgram->questions as $i => $q)
                            <div class="p-6 bg-white/10 rounded-2xl border border-white/10 group transition-all hover:bg-white/20">
                                <label class="block text-[8px] font-black text-teal-300 uppercase tracking-widest mb-3 italic">Pertanyaan #{{ $i+1 }}</label>
                                <textarea name="questions[{{ $i }}][question_text]" 
                                          class="w-full p-4 bg-transparent border-none focus:ring-0 text-white font-medium text-sm placeholder-white/30">{{ $q->question_text }}</textarea>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- TOMBOL AKSI --}}
                <div class="flex justify-end gap-6 pt-8 border-t border-gray-50">
                    <a href="{{ route('admin.sub_programs.index') }}" class="px-8 py-5 font-black text-gray-400 uppercase text-[10px] tracking-widest italic hover:text-[#006064] transition-colors">Batal</a>
                    <button type="submit" class="bg-[#FFC107] text-[#006064] font-black px-16 py-5 rounded-2xl uppercase tracking-[0.2em] text-[10px] italic shadow-xl shadow-yellow-500/20 hover:bg-yellow-500 hover:-translate-y-1 transition-all">
                        Simpan Perubahan ✨
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Script untuk delete --}}
    <script>
        function confirmDelete(url) {
            if(confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')) {
                let form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</x-admin-layout>