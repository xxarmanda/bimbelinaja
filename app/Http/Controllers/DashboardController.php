<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. CEK ROLE: Jika Admin (Role 1), arahkan ke Dashboard Admin
        if ($user->role == 1 || $user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // 2. LOGIKA SISWA: Ambil data transaksi miliknya
        // Menggunakan try-catch agar jika tabel belum ada, aplikasi tidak langsung mati
        try {
            $myTransactions = Transaction::where('user_id', $user->id)
                                ->with('program')
                                ->latest()
                                ->get();
        } catch (\Exception $e) {
            $myTransactions = collect(); // Kirim data kosong jika terjadi eror
        }

        return view('dashboard', compact('myTransactions'));
    }
}