<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic">Update Mata Pelajaran</h2>
                <p class="text-gray-500 font-medium italic">Sesuaikan materi, kartu level, dan kuis internal.</p>
            </div>
            <a href="{{ route('admin.sub-programs.index') }}" class="text-gray-400 font-black uppercase text-[10px] tracking-widest hover:text-[#006064] transition-colors italic">← Kembali ke Daftar</a>
        </div>

        {{-- PERBAIKAN 1: PESAN EROR (Agar tahu kenapa tidak bisa update) --}}
        @if ($errors->any())
            <div class="p-6 bg-red-50 border-l-4 border-red-500 rounded-3xl animate-pulse">
                <h4 class="text-red-600 font-black uppercase text-xs italic mb-2">⚠️ Ada kesalahan input:</h4>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 text-[10px] font-bold uppercase italic tracking-wider">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.sub-programs.update', $subProgram->id) }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf
            @method('PATCH') {{-- PERBAIKAN: Gunakan PATCH agar sesuai dengan Controller --}}

            {{-- 1. INFORMASI DASAR --}}
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-50">
                <h2 class="text-2xl font-black text-[#006064] uppercase mb-10 italic border-b border-gray-50 pb-4">1. Informasi Utama</h2>
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="space-y-8">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2 italic">Nama Mata Pelajaran</label>
                            <input type="text" name="name" value="{{ old('name', $subProgram->name) }}" required class="w-full p-5 rounded-2xl bg-gray-50 border-none font-bold text-[#006064] focus:ring-2 focus:ring-[#FFC107] transition-all">
                        </div>
                        <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2 italic">Harga Investasi</label>
                        {{-- PERBAIKAN: Menggunakan number_format agar muncul 300.000 --}}
                        <input type="text" 
                            name="price" 
                            value="{{ old('price', number_format($subProgram->price, 0, ',', '.')) }}" 
                            required 
                            class="w-full p-5 rounded-2xl bg-gray-50 border-none font-black text-[#006064] focus:ring-2 focus:ring-[#FFC107] transition-all"
                            placeholder="Contoh: 300.000">
                    </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2 italic">Jenjang Program</label>
                            <select name="program_id" required class="w-full p-5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FFC107] font-black text-[#006064] appearance-none cursor-pointer">
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" {{ $subProgram->program_id == $program->id ? 'selected' : '' }}>Jenjang {{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2 italic">Ikon Utama Mata Pelajaran</label>
                        <div class="bg-teal-50/30 p-8 rounded-[3rem] border-2 border-dashed border-teal-100 text-center flex flex-col items-center">
                            @if($subProgram->image)
                                <img src="{{ asset('storage/' . $subProgram->image) }}" class="w-32 h-32 rounded-3xl object-cover mb-6 shadow-xl border-4 border-white">
                            @endif
                            <input type="file" name="image" class="text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white hover:file:bg-teal-900 cursor-pointer">
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 space-y-2">
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest ml-2 italic">Deskripsi Materi</label>
                    <textarea name="description" rows="4" class="w-full p-6 rounded-[2.5rem] bg-gray-50 border-none font-medium text-gray-600 italic focus:ring-2 focus:ring-[#FFC107] resize-none">{{ old('description', $subProgram->description) }}</textarea>
                </div>
            </div>

            {{-- 2. BUILDER KUIS (Sesuai Code Awal) --}}
            <div class="bg-white rounded-[4rem] p-12 shadow-sm border border-gray-50 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-50 rounded-bl-full -z-0 opacity-50"></div>
                <div class="flex justify-between items-center mb-10 relative z-10">
                    <h2 class="text-2xl font-black text-[#006064] uppercase italic border-b-4 border-[#FFC107] pb-2">2. Builder Kuis</h2>
                    <button type="button" onclick="addQuestion()" class="bg-[#006064] text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-teal-900 transition-all shadow-lg">+ Tambah Soal Baru</button>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    @foreach($subProgram->questions as $index => $q)
                        <div class="p-6 bg-gray-50 rounded-[2rem] border border-gray-100 flex justify-between items-start group hover:bg-white hover:shadow-xl transition-all duration-500">
                            <div class="space-y-1">
                                <span class="bg-teal-100 text-teal-700 px-3 py-1 rounded-full text-[9px] font-black uppercase italic">Soal #{{ $index + 1 }}</span>
                                <p class="font-bold text-[#006064] italic text-sm mt-2 leading-relaxed">{{ $q->question_text }}</p>
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kunci: {{ $q->correct_answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="quiz-container" class="space-y-6"></div>
            </div>

            {{-- 3. KARTU LEVEL & MANFAAT --}}
            <div class="grid lg:grid-cols-2 gap-10">
                {{-- Level --}}
                <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-50">
                    <h2 class="text-2xl font-black text-[#006064] uppercase mb-8 italic">3. Kartu Level</h2>
                    <div class="space-y-4 mb-8">
                        @foreach($subProgram->items as $item)
                            <div class="bg-teal-50/50 p-6 rounded-3xl border border-teal-100 flex items-center justify-between group">
                                <div class="flex items-center space-x-4">
                                    <img src="{{ asset('storage/' . $item->icon) }}" class="h-10 w-10 object-contain">
                                    <h4 class="font-black text-[#006064] text-xs uppercase italic">{{ $item->name }} ({{ $item->age_range }})</h4>
                                </div>
                                <form action="{{ route('admin.sub-programs.destroyItem', $item->id) }}" method="POST" onsubmit="return confirm('Hapus kartu level ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition-colors opacity-0 group-hover:opacity-100 font-bold px-2">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-gray-50 p-8 rounded-[2.5rem] space-y-4 border-2 border-dashed border-teal-100">
                        <p class="font-black text-[#006064] uppercase text-[10px] italic">+ Form Level Baru</p>
                        <input type="text" name="new_item_name" placeholder="Nama Level" class="w-full p-4 rounded-xl border-none text-xs bg-white">
                        <input type="text" name="new_item_age" placeholder="Rentang Usia" class="w-full p-4 rounded-xl border-none text-xs bg-white">
                        <textarea name="new_item_desc" rows="2" placeholder="Deskripsi level..." class="w-full p-4 rounded-xl border-none text-xs bg-white resize-none"></textarea>
                        <input type="file" name="new_item_icon" class="w-full text-[10px]">
                    </div>
                </div>

                {{-- Manfaat --}}
                <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-50">
                    <h2 class="text-2xl font-black text-[#006064] uppercase mb-8 italic">4. Manfaat</h2>
                    <div class="space-y-4 mb-8">
                        @foreach($subProgram->benefits as $benefit)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 group">
                                <p class="text-xs font-bold text-gray-700 italic">{{ $benefit->title }}</p>
                                <form action="{{ route('admin.sub-programs.destroyBenefit', $benefit->id) }}" method="POST" onsubmit="return confirm('Hapus manfaat ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 font-bold px-2">✕</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    <div class="bg-yellow-50/50 p-8 rounded-[2.5rem] space-y-4 border-2 border-dashed border-yellow-100">
                        <p class="font-black text-yellow-600 uppercase text-[10px] italic">+ Form Manfaat Baru</p>
                        <input type="text" name="new_benefit_title" placeholder="Judul Manfaat" class="w-full p-4 rounded-xl border-none text-xs bg-white">
                        <textarea name="new_benefit_desc" rows="2" placeholder="Deskripsi..." class="w-full p-4 rounded-xl border-none text-xs bg-white resize-none"></textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-10">
                {{-- PERBAIKAN 2: WARNA HIJAU TEAL --}}
                <button type="submit" class="bg-[#006064] hover:bg-teal-900 text-white font-black px-16 py-6 rounded-3xl transition-all shadow-2xl shadow-teal-900/30 uppercase tracking-[0.3em] text-sm italic active:scale-95">
                    Update Seluruh Data Mata Pelajaran
                </button>
            </div>
        </form>
    </div>

    <script>
        let questionCount = 0;
        function addQuestion() {
            const container = document.getElementById('quiz-container');
            const html = `
                <div class="quiz-item p-8 bg-white rounded-[3rem] border-2 border-teal-100 shadow-xl space-y-6 relative animate-fade-in">
                    <div class="flex justify-between items-center">
                        <span class="bg-[#006064] text-white px-4 py-1 rounded-full text-[9px] font-black uppercase italic">Menyusun Soal Baru</span>
                        <button type="button" onclick="this.parentElement.parentElement.remove()" class="text-red-400 font-bold">Batal</button>
                    </div>
                    <textarea name="questions[${questionCount}][question_text]" placeholder="Tulis soal kuis baru..." class="w-full rounded-2xl border-none p-5 bg-gray-50 text-sm focus:ring-2 focus:ring-[#FFC107] italic" required></textarea>
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="questions[${questionCount}][option_a]" placeholder="Opsi A" class="p-4 rounded-xl bg-gray-50 border-none text-xs" required>
                        <input type="text" name="questions[${questionCount}][option_b]" placeholder="Opsi B" class="p-4 rounded-xl bg-gray-50 border-none text-xs" required>
                        <input type="text" name="questions[${questionCount}][option_c]" placeholder="Opsi C" class="p-4 rounded-xl bg-gray-50 border-none text-xs" required>
                        <input type="text" name="questions[${questionCount}][option_d]" placeholder="Opsi D" class="p-4 rounded-xl bg-gray-50 border-none text-xs" required>
                    </div>
                    <select name="questions[${questionCount}][correct_answer]" class="w-full rounded-xl border-none font-black text-[#006064] text-xs p-4 bg-gray-50 cursor-pointer focus:ring-2 focus:ring-[#FFC107]" required>
                        <option value="">-- JAWABAN BENAR --</option>
                        <option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option>
                    </select>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
            questionCount++;
        }
    </script>
</x-admin-layout>