<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Pembayaran - BimbelinAja</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html { scroll-behavior: smooth; }
        .dropdown:hover .dropdown-menu { opacity: 1; transform: translateY(0); pointer-events: auto; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F8FAFC] font-sans antialiased text-[#006064]">

    @include('layouts.nav')

    {{-- KONTEN INSTRUKSI --}}
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto px-6">
            <div class="bg-white rounded-[3rem] p-10 shadow-2xl border border-gray-100 text-center">
                <h2 class="text-3xl font-black text-[#006064] uppercase italic mb-8 tracking-tighter">Instruksi Pembayaran 💳</h2>
                
                {{-- AREA INFORMASI BANK --}}
                <div class="bg-teal-50 p-8 md:p-10 rounded-[2.5rem] border border-teal-100 mb-10 shadow-inner">
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-widest mb-6 italic">Silakan Transfer Ke Rekening Resmi Kami:</p>
                    
                    <div class="space-y-4">
                        {{-- Nama Bank --}}
                        <div class="bg-white inline-block px-6 py-2 rounded-xl shadow-sm border border-gray-100 mb-2">
                            <h3 class="text-2xl font-black text-[#006064] uppercase">{{ $config->bank_name }}</h3>
                        </div>
                        
                        {{-- Nomor Rekening --}}
                        <div class="flex flex-col items-center justify-center">
                            <p id="rekening" class="text-3xl md:text-4xl font-black text-gray-800 tracking-tighter">
                                {{ $config->bank_account }}
                            </p>
                            <p class="font-black text-teal-600 uppercase text-[10px] italic tracking-widest mt-2">
                                A.N. {{ $config->bank_owner }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-8 border-t border-teal-200/50">
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total yang harus dibayar:</p>
                        <p class="text-4xl md:text-5xl font-black text-[#006064] italic">
                            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                {{-- FORM UNGGAH BUKTI --}}
                <form action="{{ route('pembayaran.upload', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf 
                    @method('PATCH')
                    
                    <div class="text-left mb-10">
                        <label class="block text-[10px] font-black text-gray-400 uppercase tracking-widest mb-4 ml-4 italic">Unggah Bukti Transfer (JPG/PNG):</label>
                        <div class="relative group">
                            <input type="file" name="proof_of_payment" required 
                                   class="w-full p-6 border-2 border-dashed border-gray-200 rounded-3xl bg-gray-50 group-hover:border-[#006064] group-hover:bg-white transition-all cursor-pointer file:mr-6 file:py-3 file:px-8 file:rounded-2xl file:border-0 file:text-[10px] file:font-black file:bg-[#006064] file:text-white file:uppercase file:tracking-widest">
                        </div>
                        @error('proof_of_payment')
                            <p class="text-red-500 text-[10px] mt-3 ml-4 font-black italic uppercase tracking-widest">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <button type="submit" class="w-full bg-[#FFC107] hover:bg-yellow-500 text-[#006064] font-black py-6 rounded-[2rem] shadow-xl shadow-yellow-500/20 transition-all transform active:scale-95 uppercase tracking-[0.2em] text-xs italic">
                        Upload & Konfirmasi Pembayaran 🚀
                    </button>
                </form>
            </div>
            
            <div class="mt-12 text-center">
                <p class="text-[9px] text-gray-400 font-black uppercase tracking-[0.3em] italic">Butuh bantuan? Tim Admin kami siap melayani di WhatsApp.</p>
            </div>
        </div>
    </div>

    @include('layouts.footer')

</body>
</html>