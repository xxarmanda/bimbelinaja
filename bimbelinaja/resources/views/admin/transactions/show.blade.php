<x-admin-layout>
    <div class="p-6 no-print">
        <div class="flex gap-3 mb-8">
            <a href="{{ route('admin.transactions.index') }}" class="bg-gray-100 text-black px-6 py-3 border-2 border-black font-black text-sm uppercase tracking-tighter">
                << KEMBALI KE DAFTAR
            </a>
            <button onclick="exportTableToExcel('excelTable', 'Pendaftaran-{{ $transaction->id }}')" class="bg-green-600 text-white px-6 py-3 border-2 border-black font-black text-sm uppercase tracking-tighter">
                📥 UNDUH FILE EXCEL (.XLS)
            </button>
            <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-3 border-2 border-black font-black text-sm uppercase tracking-tighter">
                🖨️ CETAK PDF / PRINTER
            </button>
        </div>
    </div>

    <div id="printableArea" class="p-6 bg-white">
        {{-- TABEL GAYA EXCEL BESAR --}}
        <table id="excelTable" class="w-full border-collapse border-4 border-black text-base font-sans">
            <thead>
                <tr>
                    <th colspan="4" class="border-4 border-black p-6 text-2xl font-black text-center bg-gray-100 uppercase italic">
                        REKAP DATA PENDAFTARAN SISWA - BIMBELINAJA MANAGEMENT SYSTEM
                    </th>
                </tr>
            </thead>
            <tbody>
                {{-- SESUAI FORM: CARA BELAJAR, PAKET, JUMLAH PESERTA --}}
                <tr class="bg-gray-200 font-black text-sm italic uppercase tracking-widest">
                    <td colspan="4" class="border-2 border-black p-3 text-blue-900">1. PILIHAN PROGRAM & METODE BELAJAR</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold w-1/4">Cara Belajar</td>
                    <td class="border-2 border-black p-4 w-1/4 font-black uppercase text-base">{{ $transaction->learning_method ?? ($n['learning_method'] ?? '-') }}</td>
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold w-1/4">Mata Pelajaran</td>
                    <td class="border-2 border-black p-4 w-1/4 font-black text-base text-blue-800">{{ $transaction->subProgram->name ?? '-' }}</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Paket Sesi</td>
                    <td class="border-2 border-black p-4 font-black text-base">{{ $transaction->sessions ?? ($n['sessions'] ?? '-') }} Sesi / Bulan</td>
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Jumlah Peserta</td>
                    <td class="border-2 border-black p-4 font-black text-base">{{ $transaction->participants_count ?? ($n['participants_count'] ?? '1') }} Orang (Privat/Kelompok)</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Total Estimasi Biaya</td>
                    <td colspan="3" class="border-2 border-black p-4 font-black text-xl text-red-600 italic">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>

                {{-- DATA SISWA (NAMA, PANGGILAN, TGL LAHIR, GENDER) --}}
                <tr class="bg-gray-200 font-black text-sm italic uppercase tracking-widest">
                    <td colspan="4" class="border-2 border-black p-3 text-blue-900">2. INFORMASI DATA SISWA</td>
                </tr>
                @if(isset($notes['detail_siswa']))
                    @foreach($notes['detail_siswa'] as $i => $s)
                    <tr class="text-sm">
                        <td class="border-2 border-black p-4 bg-gray-50 font-black text-center text-lg italic">{{ $i + 1 }}</td>
                        <td colspan="3" class="border-2 border-black p-4">
                            <p class="font-black text-lg uppercase text-black">{{ $s['nama_lengkap'] ?? '-' }}</p>
                            <p class="font-bold text-gray-600 italic mt-1 text-sm">
                                Panggilan: <span class="text-blue-700">"{{ $s['panggilan'] ?? '-' }}"</span> | 
                                Gender: {{ $s['gender'] ?? '-' }} | 
                                Tanggal Lahir: {{ $s['tgl_lahir'] ?? '-' }}
                            </p>
                        </td>
                    </tr>
                    @endforeach
                @endif

                {{-- KONTAK & LOKASI --}}
                <tr class="bg-gray-200 font-black text-sm italic uppercase tracking-widest">
                    <td colspan="4" class="border-2 border-black p-3 text-blue-900">3. KONTAK & ALAMAT TINGGAL</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">No. WhatsApp Aktif</td>
                    <td class="border-2 border-black p-4 font-black text-lg text-green-700 underline">{{ $notes['whatsapp'] ?? '-' }}</td>
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Kota / Kabupaten</td>
                    <td class="border-2 border-black p-4 font-black uppercase text-base">{{ $notes['kota_kabupaten'] ?? '-' }}</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Alamat Lengkap</td>
                    <td colspan="3" class="border-2 border-black p-4 font-bold italic leading-relaxed text-base">"{{ $notes['alamat_lengkap'] ?? '-' }}"</td>
                </tr>

                {{-- PREFERENSI & JADWAL --}}
                <tr class="bg-gray-200 font-black text-sm italic uppercase tracking-widest">
                    <td colspan="4" class="border-2 border-black p-3 text-blue-900">4. PREFERENSI TUTOR & RENCANA JADWAL</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Preferensi Gender Tutor</td>
                    <td class="border-2 border-black p-4 font-black text-base uppercase">{{ $notes['gender_tutor_pref'] ?? ($notes['tutor_gender_pref'] ?? '-') }}</td>
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Rencana Mulai Belajar</td>
                    <td class="border-2 border-black p-4 font-black text-base text-teal-700 italic underline">{{ $notes['tgl_mulai_les'] ?? '-' }}</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Rencana Jadwal Hari/Jam</td>
                    <td class="border-2 border-black p-4 font-black text-base">{{ $notes['rencana_jadwal'] ?? '-' }}</td>
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold">Sifat Jadwal</td>
                    <td class="border-2 border-black p-4 font-black uppercase text-base text-orange-600">{{ $notes['sifat_jadwal'] ?? '-' }}</td>
                </tr>
                <tr class="text-sm">
                    <td class="border-2 border-black p-4 bg-gray-50 font-bold italic text-gray-500">Pesan Tambahan Untuk Tutor</td>
                    <td colspan="3" class="border-2 border-black p-4 italic font-medium text-gray-400">"{{ $notes['pesan_tambahan'] ?? '-' }}"</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Script Export Excel Tetap Sama --}}
    <script>
        function exportTableToExcel(tableID, filename = ''){
            var downloadLink;
            var dataType = 'application/vnd.ms-excel';
            var tableSelect = document.getElementById(tableID);
            var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
            filename = filename ? filename+'.xls' : 'bimbelinaja_data_siswa.xls';
            downloadLink = document.createElement("a");
            document.body.appendChild(downloadLink);
            if(navigator.msSaveOrOpenBlob){
                var blob = new Blob(['\ufeff', tableHTML], { type: dataType });
                navigator.msSaveOrOpenBlob( blob, filename);
            } else {
                downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
                downloadLink.download = filename;
                downloadLink.click();
            }
        }
    </script>

    <style>
        @media print {
            .no-print, header, nav, aside, button { display: none !important; }
            body, html { margin: 0; padding: 0; background: white !important; }
            main { margin-left: 0 !important; padding: 0 !important; }
            #printableArea { width: 100% !important; padding: 0 !important; margin: 0 !important; }
            table { border: 4px solid black !important; width: 100% !important; border-collapse: collapse !important; }
            td, th { border: 2px solid black !important; padding: 10px !important; }
        }
    </style>
</x-admin-layout>