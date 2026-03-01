<x-admin-layout>
    <div class="space-y-10 py-6">
        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black text-[#006064] uppercase tracking-tighter italic leading-none text-teal-800">Manajemen Rekening Pembayaran</h2>
                <p class="text-gray-500 font-medium italic mt-2 flex items-center">
                    <span class="w-10 h-[2px] bg-teal-100 mr-2"></span> Atur data bank yang akan tampil di instruksi pembayaran siswa.
                </p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-[#006064] text-white p-5 rounded-[2.5rem] font-bold italic shadow-xl flex items-center animate-fade-in">
                <span class="mr-3 text-xl">✅</span> {{ session('success') }}
            </div>
        @endif

        {{-- FORM PENGATURAN (SEKSI 2 DIHAPUS) --}}
        <form action="{{ route('admin.payment-configs.update') }}" method="POST" class="max-w-4xl mx-auto space-y-8">
            @csrf
            @method('PATCH')

            {{-- HANYA SEKSI 1: DATA REKENING --}}
            <div class="bg-white rounded-[3.5rem] p-12 shadow-sm border border-gray-50 space-y-10">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="bg-[#FFC107] text-[#006064] px-4 py-1 rounded-full font-black uppercase italic text-[9px] tracking-widest">Seksi Utama</div>
                    <h3 class="text-xl font-black text-[#006064] uppercase italic">Informasi Bank & Rekening</h3>
                </div>

                <div class="grid md:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Nama Bank</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $config->bank_name) }}" required 
                               class="w-full p-5 rounded-2xl bg-gray-50 border-none font-black text-[#006064] focus:ring-2 focus:ring-[#FFC107] shadow-inner" placeholder="Contoh: BANK BCA">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Nomor Rekening</label>
                        <input type="text" name="bank_account" value="{{ old('bank_account', $config->bank_account) }}" required 
                               class="w-full p-5 rounded-2xl bg-gray-50 border-none font-black text-[#006064] focus:ring-2 focus:ring-[#FFC107] shadow-inner" placeholder="Contoh: 123-4567-890">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[10px] font-black uppercase text-gray-400 italic ml-2">Atas Nama (A.N.) Pemilik Rekening</label>
                    <input type="text" name="bank_owner" value="{{ old('bank_owner', $config->bank_owner) }}" required 
                           class="w-full p-5 rounded-2xl bg-gray-50 border-none font-black text-[#006064] focus:ring-2 focus:ring-[#FFC107] shadow-inner" placeholder="Contoh: BIMBELINAJA SIGNATURE">
                </div>

                {{-- Hidden input agar biaya registrasi tetap tersimpan di DB tanpa muncul di layar --}}
                <input type="hidden" name="registration_fee" value="{{ $config->registration_fee ?? 95000 }}">

                <div class="p-8 bg-teal-50/50 rounded-[2.5rem] border border-dashed border-teal-200">
                    <p class="text-[10px] font-black text-teal-700 uppercase italic mb-2">💡 Info Sistem:</p>
                    <p class="text-teal-600 text-[10px] font-medium leading-relaxed">
                        Nominal keseluruhan (Total Estimasi) dihitung otomatis oleh sistem. Perubahan di sini hanya akan mengubah data nomor rekening dan tujuan transfer.
                    </p>
                </div>
            </div>

            {{-- TOMBOL SIMPAN --}}
            <div class="flex justify-center">
                <button type="submit" class="bg-[#006064] hover:bg-teal-900 text-white font-black px-20 py-6 rounded-[2.5rem] shadow-2xl shadow-teal-900/30 uppercase tracking-[0.4em] text-sm italic transition-all active:scale-95">
                    Update Data Rekening
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>