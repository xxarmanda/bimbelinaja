@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-10 rounded-[3rem] shadow-xl border border-gray-100">
    <h2 class="text-2xl font-black text-[#006064] uppercase italic mb-8">Input Profile Tutor</h2>

    {{-- Alert Error jika validasi gagal --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
            <ul class="list-disc list-inside text-red-700 text-xs font-bold uppercase italic">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tutors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        {{-- --- BAGIAN BARU: DROPDOWN JENJANG --- --}}
        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Pilih Jenjang / Program</label>
            <select name="program_id" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
                <option value="">-- PILIH PROGRAM LES --</option>
                @foreach($programs as $p)
                    <option value="{{ $p->id }}" {{ old('program_id') == $p->id ? 'selected' : '' }}>
                        Jenjang {{ $p->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Sarah Azhari" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
        </div>

        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Spesialisasi / Role</label>
            <input type="text" name="role" value="{{ old('role') }}" required placeholder="Contoh: Spesialis Bahasa Inggris" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none transition-all">
        </div>

        <div>
            <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2 ml-2">Foto Profile</label>
            <input type="file" name="photo" required class="w-full bg-gray-50 border-2 border-dashed border-gray-100 rounded-2xl p-4 text-xs font-bold text-gray-400">
        </div>

        <button type="submit" class="w-full bg-[#006064] text-white font-black py-5 rounded-2xl shadow-lg uppercase tracking-widest text-[10px] hover:bg-teal-900 transition-all">
            Simpan Data Tutor
        </button>
    </form>
</div>
@endsection