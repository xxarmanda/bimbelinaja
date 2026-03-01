@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto pb-20">
    <div class="mb-10 flex items-center justify-between">
        <div>
            <h2 class="text-3xl font-black text-[#006064] uppercase italic tracking-tighter">Edit Keuntungan</h2>
            <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mt-1">Perbarui judul, deskripsi, atau ikon keuntungan</p>
        </div>
        <a href="{{ route('admin.benefits.index') }}" class="text-[#006064] font-black text-[10px] uppercase tracking-widest">Kembali</a>
    </div>

    <form action="{{ route('admin.benefits.update', $benefit->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 space-y-6">
        @csrf @method('PUT')
        
        <div>
            <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2">Judul Keuntungan</label>
            <input type="text" name="title" value="{{ $benefit->title }}" required 
                   class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none">
        </div>

        <div>
            <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2">Deskripsi</label>
            <textarea name="description" required class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-4 font-bold text-sm focus:border-[#006064] outline-none h-32">{{ $benefit->description }}</textarea>
        </div>

        <div>
            <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2">Ikon Saat Ini</label>
            <div class="mb-4 bg-teal-50 w-20 h-20 rounded-2xl flex items-center justify-center p-3">
                <img src="{{ asset('storage/' . $benefit->image) }}" class="w-full h-full object-contain">
            </div>
            <label class="block text-[10px] font-black text-[#006064] uppercase mb-2 ml-2">Ganti Ikon (Biarkan kosong jika tidak ingin ganti)</label>
            <input type="file" name="image" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl p-3 text-xs file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white">
        </div>

        <button type="submit" class="w-full bg-[#006064] text-white font-black py-4 rounded-xl shadow-lg uppercase tracking-widest text-[10px] hover:bg-teal-900 transition-all">
            Simpan Perubahan ✨
        </button>
    </form>
</div>
@endsection