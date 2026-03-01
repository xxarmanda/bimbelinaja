<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- 1. HEADER --}}
        <div>
            <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic">Tambah Mata Pelajaran Baru</h2>
            <p class="text-gray-500 mt-1 font-medium italic">Input data utama, manfaat, dan kuis interaktif pertama.</p>
        </div>

        {{-- 2. KARTU FORM UTAMA --}}
        <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-50">
            <form action="{{ route('admin.sub-programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
                @csrf

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- Nama Mata Pelajaran --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 ml-2 italic">Nama Mata Pelajaran</label>
                        <input type="text" name="name" required placeholder="Contoh: Matematika, Coding, atau IPA" 
                               class="w-full p-5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#006064] transition-all font-medium text-gray-600">
                    </div>

                    {{-- Pilih Jenjang --}}
                    <div class="space-y-3">
                        <label class="block text-sm font-bold text-gray-700 ml-2 italic">Pilih Jenjang Program</label>
                        <select name="program_id" required class="w-full p-5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#006064] font-bold text-[#006064] cursor-pointer">
                            <option value="" disabled selected>-- Pilih Jenjang --</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Harga --}}
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 ml-2 italic">Harga Investasi (Maks Rp 10jt)</label>
                    <input type="number" name="price" max="10000000" required placeholder="Contoh: 150000" 
                           class="w-full p-5 rounded-2xl bg-gray-50 border-none focus:ring-2 focus:ring-[#006064] font-bold text-[#006064]">
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-3">
                    <label class="block text-sm font-bold text-gray-700 ml-2 italic">Deskripsi Pelajaran</label>
                    <textarea name="description" rows="4" placeholder="Jelaskan detail materi..." 
                              class="w-full p-6 rounded-[2rem] bg-gray-50 border-none focus:ring-2 focus:ring-[#006064] font-medium text-gray-600"></textarea>
                </div>

                <div class="grid md:grid-cols-2 gap-10 pt-10 border-t border-gray-100">
                    {{-- 3. INPUT KARTU LEVEL (Awal) --}}
                    <div class="space-y-4">
                        <h3 class="font-black text-[#006064] uppercase text-sm italic ml-2">Input Kartu Level (Awal)</h3>
                        <input type="text" name="new_item_name" placeholder="Nama: Builder Junior" class="w-full p-4 rounded-xl bg-gray-50 border-none text-sm">
                        <input type="text" name="new_item_age" placeholder="Usia: 3-7 Tahun" class="w-full p-4 rounded-xl bg-gray-50 border-none text-sm">
                        
                       <div class="relative group">
                        <label class="w-full p-4 rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 text-gray-400 text-sm flex items-center justify-between cursor-pointer hover:bg-teal-50 transition-colors">
                            <span class="file-label">Upload Ikon Level</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                            </svg>
                            <input type="file" name="new_item_icon"
                                accept="image/png, image/jpeg, image/jpg"
                                class="hidden"
                                onchange="showFileName(this)">
                        </label>
                    </div>
                        {{-- INFO FORMAT IKON LEVEL --}}
                        <div class="mt-2 ml-1">
                            <p class="text-[8px] font-black text-black uppercase tracking-widest italic">* Format: PNG, JPG, JPEG (Maks 1MB)</p>
                            <p class="text-[8px] font-black text-red-600 uppercase tracking-widest italic mt-0.5">🚫 Dilarang Upload PDF Atau Dokumen</p>
                        </div>

                        <textarea name="new_item_desc" rows="2" placeholder="Deskripsi kartu level..." class="w-full p-4 rounded-xl bg-gray-50 border-none text-sm"></textarea>
                    </div>

                    {{-- 4. DAFTAR MANFAAT BELAJAR --}}
                    <div class="space-y-4">
                        <h3 class="font-black text-[#D4A017] uppercase text-sm italic ml-2">Daftar Manfaat Belajar</h3>
                        <input type="text" name="new_benefit_title" placeholder="Judul Manfaat (Contoh: Sertifikat Resmi)" class="w-full p-4 rounded-xl bg-gray-50 border-none text-sm focus:ring-2 focus:ring-[#D4A017]">
                        <textarea name="new_benefit_desc" rows="5" placeholder="Penjelasan manfaat belajar..." class="w-full p-4 rounded-xl bg-gray-50 border-none text-sm focus:ring-2 focus:ring-[#D4A017]"></textarea>
                    </div>
                </div>

                {{-- 5. BUILDER KUIS MULTI-SOAL --}}
                <div class="bg-teal-50/50 p-10 rounded-[3rem] border border-dashed border-teal-300 space-y-8">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-black text-[#006064] uppercase italic">Builder Kuis BimbelinAja</h3>
                        <button type="button" onclick="addQuestion()" class="bg-teal-600 text-white px-6 py-2 rounded-xl font-bold text-xs uppercase italic hover:bg-teal-800 transition-all shadow-md">+ Tambah Soal</button>
                    </div>
                    
                    <div id="quiz-container" class="space-y-8">
                        <div class="quiz-item p-6 bg-white rounded-3xl shadow-sm border border-teal-100 space-y-4">
                            <p class="font-bold text-teal-600 italic uppercase text-[10px]">Soal #1</p>
                            <textarea name="questions[0][question_text]" placeholder="Tulis soal kuis di sini..." class="w-full rounded-2xl border-none p-4 bg-gray-50 text-sm focus:ring-2 focus:ring-[#006064] shadow-inner"></textarea>
                            <div class="grid md:grid-cols-2 gap-4">
                                <input type="text" name="questions[0][option_a]" placeholder="Opsi A" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                                <input type="text" name="questions[0][option_b]" placeholder="Opsi B" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                                <input type="text" name="questions[0][option_c]" placeholder="Opsi C" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                                <input type="text" name="questions[0][option_d]" placeholder="Opsi D" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                            </div>
                            <select name="questions[0][correct_answer]" class="w-full rounded-xl border-none font-bold text-[#006064] text-sm p-4 cursor-pointer bg-gray-50 focus:ring-2 focus:ring-[#006064]">
                                <option value="">-- Pilih Jawaban Benar --</option>
                                <option value="A">Opsi A</option><option value="B">Opsi B</option><option value="C">Opsi C</option><option value="D">Opsi D</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- 6. SAMPUL UTAMA --}}
                <div class="space-y-3 pt-6 border-t border-gray-100">
                    <label class="block text-sm font-bold text-gray-700 ml-2 italic">Gambar Sampul Utama (Cover)</label>
                    <input type="file" name="image" required accept="image/png, image/jpeg, image/jpg" class="w-full p-4 rounded-2xl bg-gray-50 border-none text-gray-400 text-sm">
                    
                    {{-- INFO FORMAT SAMPUL UTAMA --}}
                    <div class="mt-3 ml-2">
                        <p class="text-[9px] text-black font-black uppercase tracking-widest italic">* Format: JPG, PNG, JPEG (Maks 2MB)</p>
                        <p class="text-[9px] text-red-600 font-black uppercase tracking-widest italic mt-1">🚫 Dilarang Upload PDF Atau File Dokumen Lainnya</p>
                    </div>
                </div>

                {{-- 7. TOMBOL AKSI --}}
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('admin.sub-programs.index') }}" class="px-8 py-4 rounded-2xl font-bold text-gray-400 hover:text-gray-600 transition uppercase tracking-widest text-xs italic">Batal</a>
                    <button type="submit" class="bg-[#006064] hover:bg-teal-950 text-white font-black px-12 py-5 rounded-2xl transition shadow-xl shadow-teal-900/20 uppercase tracking-widest text-sm italic">
                        Simpan Pelajaran & Kuis
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- 8. JAVASCRIPT --}}
    <script>
        let questionCount = 1;
        function addQuestion() {
            const container = document.getElementById('quiz-container');
            const html = `
                <div class="quiz-item p-6 bg-white rounded-3xl shadow-sm border border-teal-100 space-y-4 mt-6">
                    <p class="font-bold text-teal-600 italic uppercase text-[10px]">Soal #${questionCount + 1}</p>
                    <textarea name="questions[${questionCount}][question_text]" placeholder="Tulis soal baru di sini..." class="w-full rounded-2xl border-none p-4 bg-gray-50 text-sm focus:ring-2 focus:ring-[#006064] shadow-inner"></textarea>
                    <div class="grid md:grid-cols-2 gap-4">
                        <input type="text" name="questions[${questionCount}][option_a]" placeholder="Opsi A" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                        <input type="text" name="questions[${questionCount}][option_b]" placeholder="Opsi B" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                        <input type="text" name="questions[${questionCount}][option_c]" placeholder="Opsi C" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                        <input type="text" name="questions[${questionCount}][option_d]" placeholder="Opsi D" class="p-3 rounded-xl border-none bg-gray-50 text-sm">
                    </div>
                    <select name="questions[${questionCount}][correct_answer]" class="w-full rounded-xl border-none font-bold text-[#006064] text-sm p-4 cursor-pointer bg-gray-50 focus:ring-2 focus:ring-[#006064]">
                        <option value="">-- Pilih Jawaban Benar --</option>
                        <option value="A">Opsi A</option><option value="B">Opsi B</option><option value="C">Opsi C</option><option value="D">Opsi D</option>
                    </select>
                </div>`;
            container.insertAdjacentHTML('beforeend', html);
            questionCount++;
        }
    </script>
</x-admin-layout>