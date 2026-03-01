<x-admin-layout>

@php
    $notes = is_array($transaction->notes)
        ? $transaction->notes
        : json_decode($transaction->notes ?? '{}', true);
@endphp

<div class="p-6">

    {{-- ACTION BUTTON --}}
    <div class="flex flex-wrap gap-3 mb-6">
        <a href="{{ route('admin.transactions.index') }}"
           class="px-5 py-2 border-2 border-[#006064] text-[#006064] rounded-lg font-bold text-xs hover:bg-[#006064] hover:text-white">
            ← Kembali
        </a>

        <button onclick="exportExcel()"
            class="px-5 py-2 bg-emerald-600 text-white rounded-lg font-bold text-xs">
            Simpan Excel
        </button>

        <button onclick="printData()"
            class="px-5 py-2 bg-blue-600 text-white rounded-lg font-bold text-xs">
            Cetak Rekapan
        </button>
    </div>

    {{-- PRINT AREA --}}
    <div id="printableArea" class="bg-white p-6 rounded-xl shadow">

        <table id="excelTable" class="w-full border border-gray-300 text-sm">

            <thead class="bg-gray-100">
                <tr>
                    <th colspan="4" class="border px-4 py-3 text-lg font-black text-[#006064] text-center uppercase">
                        Rekap Data Pendaftaran Siswa
                    </th>
                </tr>
            </thead>

            <tbody>

                {{-- IDENTITAS TRANSAKSI --}}
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border px-4 py-2 text-[#006064]">Identitas Transaksi</td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">ID</td>
                    <td class="border px-3 py-2">#{{ $transaction->id }}</td>
                    <td class="border px-3 py-2 font-bold">Tanggal</td>
                    <td class="border px-3 py-2">
                        {{ optional($transaction->created_at)->format('d M Y H:i') ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Nama</td>
                    <td class="border px-3 py-2">{{ $transaction->guest_name }}</td>
                    <td class="border px-3 py-2 font-bold">Status</td>
                    <td class="border px-3 py-2 font-bold uppercase">
                        {{ strtoupper($transaction->status) }}
                    </td>
                </tr>

                {{-- PROGRAM --}}
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border px-4 py-2 text-[#006064]">Program & Biaya</td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Pelajaran</td>
                    <td class="border px-3 py-2">{{ $transaction->subProgram->name ?? '-' }}</td>
                    <td class="border px-3 py-2 font-bold">Metode</td>
                    <td class="border px-3 py-2">
                        {{ ucfirst($transaction->learning_method ?? '-') }}
                    </td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Sesi</td>
                    <td class="border px-3 py-2">
                        {{ $transaction->sessions ?? '-' }} sesi / bulan
                    </td>
                    <td class="border px-3 py-2 font-bold">Peserta</td>
                    <td class="border px-3 py-2">
                        {{ $notes['participants_count'] ?? '1' }}
                    </td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Total</td>
                    <td colspan="3" class="border px-3 py-2 font-bold">
                        Rp {{ number_format($transaction->amount,0,',','.') }}
                    </td>
                </tr>

                {{-- DATA SISWA --}}
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border px-4 py-2 text-[#006064]">Data Peserta Didik</td>
                </tr>

                @foreach($notes['detail_siswa'] ?? [] as $no => $s)
                <tr class="bg-gray-50">
                    <td colspan="4" class="border px-3 py-2 font-bold">
                        Peserta {{ $no + 1 }}
                    </td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Nama</td>
                    <td class="border px-3 py-2">{{ $s['nama_lengkap'] ?? '-' }}</td>
                    <td class="border px-3 py-2 font-bold">Gender</td>
                    <td class="border px-3 py-2">{{ $s['gender'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Panggilan</td>
                    <td class="border px-3 py-2">{{ $s['panggilan'] ?? '-' }}</td>
                    <td class="border px-3 py-2 font-bold">Tgl Lahir</td>
                    <td class="border px-3 py-2">{{ $s['tgl_lahir'] ?? '-' }}</td>
                </tr>
                @endforeach

                {{-- KONTAK --}}
                <tr class="bg-gray-100 font-bold">
                    <td colspan="4" class="border px-4 py-2 text-[#006064]">Kontak & Alamat</td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Whatsapp</td>
                    <td class="border px-3 py-2">{{ $notes['whatsapp'] ?? '-' }}</td>
                    <td class="border px-3 py-2 font-bold">Kota</td>
                    <td class="border px-3 py-2">{{ $notes['kota_kabupaten'] ?? '-' }}</td>
                </tr>

                <tr>
                    <td class="border px-3 py-2 font-bold">Alamat</td>
                    <td colspan="3" class="border px-3 py-2">
                        {{ $notes['alamat_lengkap'] ?? '-' }}
                    </td>
                </tr>

            </tbody>
        </table>

    </div>
</div>

{{-- EXPORT EXCEL --}}
<script>
function exportExcel() {
    let table = document.getElementById("excelTable").outerHTML;

    let html = `
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            table { border-collapse: collapse; width: 100%; }
            th, td { border:1px solid #000; padding:6px; }
            th { background:#eee; font-weight:bold; }
        </style>
    </head>
    <body>${table}</body>
    </html>`;

    let blob = new Blob(['\ufeff', html], {
        type: 'application/vnd.ms-excel;charset=utf-8;'
    });

    let url = URL.createObjectURL(blob);
    let link = document.createElement("a");
    link.href = url;
    link.download = "rekap-pendaftaran-{{ $transaction->id }}.xls";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>

{{-- PRINT --}}
<script>
function printData() {
    let printContents = document.getElementById("printableArea").innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload();
}
</script>

{{-- STYLE PRINT --}}
<style>
@media print {
    body {
        font-size: 12px;
        background: white !important;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #000 !important;
        padding: 6px !important;
    }

    thead th {
        background: #eee !important;
        -webkit-print-color-adjust: exact;
    }
}
</style>

</x-admin-layout>