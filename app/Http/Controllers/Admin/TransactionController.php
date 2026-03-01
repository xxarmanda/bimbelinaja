<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    /**
     * Menampilkan daftar semua pendaftaran masuk
     */
    public function index(Request $request)
    {
        $programs = \App\Models\Program::all();

        $query = Transaction::with(['subProgram.program']);

        if ($request->filled('search')) {
            $query->where('guest_name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('program_id')) {
            $query->whereHas('subProgram', function ($q) use ($request) {
                $q->where('program_id', $request->program_id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->latest()->get();

        return view('admin.transactions.index', compact('transactions', 'programs'));
    }

    /**
     * Detail transaksi
     */
    public function show($id)
    {
        $transaction = Transaction::with('subProgram')->findOrFail($id);

        $notes = [];
        if ($transaction->notes) {
            $notes = is_array($transaction->notes)
                ? $transaction->notes
                : json_decode($transaction->notes, true);
        }

        return view('admin.transactions.show', compact('transaction', 'notes'));
    }

    /**
     * Verifikasi Pembayaran
     */
    public function verify($id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update([
            'status' => 'success',
        ]);

        return back()->with('success', 'Pembayaran ' . $transaction->guest_name . ' berhasil diverifikasi ✅');
    }

    /**
     * Hapus data transaksi + file bukti pembayaran
     */
    public function destroy($id)
    {
        try {
            $transaction = Transaction::findOrFail($id);

            if ($transaction->proof_of_payment) {
                $path = public_path('uploads/proofs/' . $transaction->proof_of_payment);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }

            $transaction->delete();

            return back()->with('success', 'Data transaksi berhasil dihapus.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    /**
     * Simpan transaksi baru (form pendaftaran)
     */
    public function store(Request $request)
{
    $request->validate([
        'learning_method'      => 'required',
        'sessions'             => 'required',
        'participants_count'   => 'required',
        'student_names'        => 'required|array',
        'nicknames'            => 'required|array',
        'birth_dates'          => 'required|array',
        'student_genders'      => 'required|array',
        'whatsapp'             => 'required',
        'city'                 => 'required',
        'address'              => 'required',
    ]);

    // ==== DETAIL SISWA ====
    $detailSiswa = [];
    foreach ($request->student_names as $i => $name) {
        $detailSiswa[] = [
            'nama_lengkap' => $name,
            'panggilan'    => $request->nicknames[$i] ?? '',
            'tgl_lahir'    => $request->birth_dates[$i] ?? '',
            'gender'       => $request->student_genders[$i] ?? '',
        ];
    }

    // ==== NOTES JSON ====
    $notes = [
        'learning_method'     => $request->learning_method,
        'sessions'            => $request->sessions,
        'participants_count'  => $request->participants_count,
        'whatsapp'            => $request->whatsapp,
        'kota_kabupaten'      => $request->city,
        'alamat_lengkap'      => $request->address,
        'tutor_gender_pref'   => $request->tutor_gender_pref ?? null,
        'start_date'          => $request->start_date ?? null,
        'schedule'            => $request->schedule ?? null,
        'schedule_type'       => $request->schedule_type ?? null,
        'additional_message'  => $request->additional_message ?? null,
        'detail_siswa'        => $detailSiswa,
    ];

    // ==== SIMPAN TRANSAKSI (FORCED SAVE) ====
    $trx = new Transaction();
    $trx->guest_name         = $request->student_names[0];
    $trx->sub_program_id     = $request->sub_program_id;
    $trx->learning_method    = $request->learning_method;
    $trx->sessions           = $request->sessions;
    $trx->participants_count = $request->participants_count;
    $trx->amount             = $this->calculateTotal($request);
    $trx->status             = 'pending';
    $trx->notes              = $notes;
    $trx->save();

    return redirect()->route('success')
        ->with('success', 'Pendaftaran berhasil, silakan lanjutkan pembayaran.');
}
    /**
     * Hitung total pembayaran
     */
    private function calculateTotal(Request $request)
    {
        $subProgram = \App\Models\SubProgram::findOrFail($request->sub_program_id);

        $basePrice     = $subProgram->price;
        $sessions      = (int) $request->sessions;
        $participants  = (int) $request->participants_count;

        // Faktor sesi (4 = 1x, 8 = 2x, 12 = 3x)
        $sessionFactor = $sessions / 4;

        // Faktor peserta (1 = 1x, 2 = 1.5x, 3 = 2x dst)
        $participantFactor = 1 + (($participants - 1) * 0.5);

        return (int) (($basePrice * $sessionFactor) * $participantFactor);
    }
}