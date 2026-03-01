<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran masuk
     */
    public function index()
    {
        // Mengambil transaksi terbaru yang perlu diperiksa
        $transactions = Transaction::with('subProgram')->latest()->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * FITUR BARU: Menampilkan Detail Pendaftaran untuk Dicetak ✨
     * Menggunakan Route Model Binding untuk mengambil data otomatis berdasarkan ID
     */
    public function show(Transaction $transaction)
    {
        // 1. Memuat relasi subProgram agar nama mata pelajaran muncul di laporan
        $transaction->load('subProgram');

        // 2. Decode data 'notes' (JSON) menjadi array agar bisa dibaca di Blade
        // Ini berisi detail siswa, alamat, dan jadwal yang diisi saat pendaftaran
        $notes = json_decode($transaction->notes, true);
        
        // 3. Kirim data ke view detail
        return view('admin.transactions.show', compact('transaction', 'notes'));
    }

    /**
     * Verifikasi Pembayaran Siswa
     */
    public function verify($id)
    {
        // 1. Cari data transaksi berdasarkan ID
        $transaction = Transaction::findOrFail($id);

        // 2. Ubah status menjadi 'success'
        $transaction->update([
            'status' => 'success'
        ]);

        // 3. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Pembayaran ' . $transaction->guest_name . ' Berhasil Diverifikasi! ✅');
    }
}