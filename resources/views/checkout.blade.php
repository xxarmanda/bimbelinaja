<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-3xl font-black text-[#006064] uppercase italic mb-8">Ringkasan Pendaftaran</h2>
            
            <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-100">
                <div class="flex items-center gap-6 mb-8 pb-8 border-b">
                    <img src="{{ asset('storage/' . $program->image) }}" class="w-32 h-32 rounded-2xl object-cover shadow-md">
                    <div>
                        <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest italic">Mata Pelajaran</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $program->name }}</h3>
                        <p class="text-[#006064] font-black text-xl italic mt-2">Rp {{ number_format($program->price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="space-y-4 mb-10">
                    <p class="text-gray-500 italic text-sm">Dengan mengklik tombol di bawah, Anda akan didaftarkan ke program ini dan status pendaftaran akan menjadi <strong>Pending</strong> sampai pembayaran diverifikasi.</p>
                </div>

                <form action="{{ route('transaction.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sub_program_id" value="{{ $program->id }}">
                    <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-5 rounded-2xl transition shadow-lg shadow-yellow-500/20 uppercase tracking-widest">
                        Konfirmasi & Bayar Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>