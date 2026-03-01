<x-admin-layout>
    <div class="max-w-4xl mx-auto pb-20">
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter">
                Edit Data Tutor: <span class="text-teal-500">{{ $tutor->name }}</span>
            </h2>
            <p class="text-gray-400 mt-2 font-bold uppercase tracking-widest text-[10px]">Perbarui informasi pengajar profesional BimbelinAja</p>
        </div>

        {{-- PERBAIKAN: Form dibuka dan baru ditutup di akhir tombol simpan --}}
        <form action="{{ route('admin.tutors.update', $tutor) }}" method="POST" enctype="multipart/form-data" class="bg-white p-12 rounded-[3rem] shadow-sm border border-gray-100 space-y-10">
            @csrf
            @method('PATCH')

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-2 italic">Jenjang Program Les</label>
                    <select name="program_id" class="w-full p-5 bg-gray-50 border-2 border-transparent focus:border-[#006064] rounded-2xl font-bold text-sm outline-none transition-all" required>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id', $tutor->program_id) == $program->id ? 'selected' : '' }}>
                                Jenjang {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-2 italic">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $tutor->name) }}" class="w-full p-5 bg-gray-50 border-2 border-transparent focus:border-[#006064] rounded-2xl font-bold text-sm outline-none transition-all" required>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-2 italic">Spesialisasi / Role (Contoh: Tutor Matematika)</label>
                    <input type="text" name="role" value="{{ old('role', $tutor->role) }}" class="w-full p-5 bg-gray-50 border-2 border-transparent focus:border-[#006064] rounded-2xl font-bold text-sm outline-none transition-all" required>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase tracking-widest text-[#006064] ml-2 italic">Foto Profil (Kosongkan jika tidak diganti)</label>
                    <input type="file" name="photo" class="w-full p-4 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl font-bold text-xs">
                </div>
            </div>

            <div class="pt-10 flex items-center justify-between border-t border-gray-50">
                <a href="{{ route('admin.tutors.index') }}" class="text-gray-400 font-black text-[10px] uppercase tracking-widest hover:text-red-500 transition italic">Batal & Kembali</a>
                <button type="submit" class="bg-[#006064] text-white py-5 px-12 rounded-2xl font-black uppercase tracking-widest shadow-xl hover:bg-teal-900 transition-all hover:scale-105 text-xs">
                    Simpan Perubahan ✨
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>