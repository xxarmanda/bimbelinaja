<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $transaction->id }}</title>
    <style>
        /* CSS Murni khusus untuk DomPDF */
        body { font-family: 'Helvetica', Arial, sans-serif; color: #333; line-height: 1.5; margin: 0; padding: 0; }
        .container { padding: 40px; }
        .header { background-color: #006064; color: white; padding: 30px; border-radius: 15px; margin-bottom: 30px; }
        .header table { width: 100%; border: none; }
        .header h1 { margin: 0; font-size: 28px; text-transform: uppercase; font-style: italic; }
        .header p { margin: 5px 0 0 0; opacity: 0.8; font-size: 12px; }
        
        .info-table { width: 100%; margin-bottom: 30px; }
        .info-table td { vertical-align: top; font-size: 13px; }
        
        .status-badge { 
            display: inline-block; padding: 6px 15px; border-radius: 5px; font-weight: bold; font-size: 10px; 
            text-transform: uppercase; border: 2px solid #006064; color: #006064; margin-bottom: 20px;
        }

        .items-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .items-table th { background-color: #f4f4f4; padding: 12px; text-align: left; font-size: 12px; border-bottom: 2px solid #006064; }
        .items-table td { padding: 12px; border-bottom: 1px solid #eee; font-size: 12px; }
        
        .total-section { margin-top: 30px; text-align: right; }
        .total-label { font-size: 12px; color: #777; font-weight: bold; text-transform: uppercase; }
        .total-price { font-size: 24px; color: #006064; font-weight: 900; margin-top: 5px; }
        
        .footer { margin-top: 50px; text-align: center; font-size: 10px; color: #aaa; border-top: 1px solid #eee; padding-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        {{-- HEADER --}}
        <div class="header">
            <table>
                <tr>
                    <td>
                        <h1>BimbelinAja</h1>
                        <p>Signature Learning System</p>
                    </td>
                    <td style="text-align: right;">
                        <p style="font-weight: bold; font-size: 14px;">INVOICE RESMI</p>
                        <p>ID Transaksi: #{{ $transaction->id }}</p>
                        <p>Tanggal: {{ $transaction->created_at->format('d M Y') }}</p>
                    </td>
                </tr>
            </table>
        </div>

        {{-- STATUS --}}
        <div class="status-badge">
            {{ $transaction->status == 'success' ? 'LUNAS / VERIFIED' : 'PENDING VERIFIKASI' }}
        </div>

        {{-- INFO PEMBAYAR --}}
        <table class="info-table">
            <tr>
                <td style="width: 50%;">
                    <strong style="color: #006064; text-transform: uppercase; font-size: 10px;">Ditujukan Kepada:</strong><br>
                    <span style="font-size: 16px; font-weight: bold;">{{ $details['detail_siswa'][0]['nama_lengkap'] ?? $transaction->guest_name }}</span><br>
                    WA: {{ $details['whatsapp'] ?? '-' }}<br>
                    Lokasi: {{ $details['kota_kabupaten'] ?? '-' }}
                </td>
                <td style="width: 50%; text-align: right;">
                    <strong style="color: #006064; text-transform: uppercase; font-size: 10px;">Metode Transfer:</strong><br>
                    Bank: {{ $config->bank_name ?? 'BANK BCA' }}<br>
                    Rek: {{ $config->bank_account ?? '-' }}<br>
                    A.N: {{ $config->bank_owner ?? '-' }}
                </td>
            </tr>
        </table>

        {{-- RINCIAN BIAYA --}}
        <table class="items-table">
            <thead>
                <tr>
                    <th>Deskripsi Layanan</th>
                    <th style="text-align: center;">Jumlah</th>
                    <th style="text-align: right;">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <strong>{{ $transaction->subProgram->name ?? 'Program Les' }}</strong><br>
                        <small style="color: #888;">Paket {{ $details['paket_info']['sesi'] ?? 4 }} Sesi - Metode {{ $details['paket_info']['metode'] ?? 'Offline' }}</small>
                    </td>
                    <td style="text-align: center;">1 Paket</td>
                    <td style="text-align: right;">
                        Rp {{ number_format($transaction->amount - ($details['paket_info']['biaya_registrasi'] ?? 95000), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>Biaya Registrasi</strong><br>
                        <small style="color: #888;">Biaya administrasi pendaftaran siswa baru</small>
                    </td>
                    <td style="text-align: center;">1x</td>
                    <td style="text-align: right;">
                        Rp {{ number_format($details['paket_info']['biaya_registrasi'] ?? 95000, 0, ',', '.') }}
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- TOTAL --}}
        <div class="total-section">
            <div class="total-label">Total Pembayaran</div>
            <div class="total-price">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</div>
        </div>

        {{-- FOOTER --}}
        <div class="footer">
            <p>Invoice ini diterbitkan secara otomatis oleh sistem BimbelinAja dan merupakan bukti pembayaran yang sah.</p>
            <p>&copy; {{ date('Y') }} BimbelinAja Signature System. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>