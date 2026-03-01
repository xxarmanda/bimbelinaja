<?php

namespace App\Http\Controllers;

use App\Models\Program; 
use App\Models\SubProgram;
use App\Models\Transaction;
use App\Models\PaymentConfig; 
use Illuminate\Http\Request;

// Tambahkan Import PDF di sini
use Barryvdh\DomPDF\Facade\Pdf;

class StudentTransactionController extends Controller
{
    /**
     * Menampilkan Halaman Checkout
     */
    public function checkout($id) {
        $program = SubProgram::with('program')->findOrFail($id);
        $programs = Program::all(); 
        
        return view('student.checkout', compact('program', 'programs'));
    }

    /**
     * Menyimpan Data Transaksi (Pendaftaran)
     */
    public function store(Request $request) {
        $subProgram = SubProgram::findOrFail($request->sub_program_id);
        
        // 1. AMBIL KONFIGURASI BIAYA (Safety Net jika DB kosong)
        $config = PaymentConfig::first() ?? new PaymentConfig();
        $biayaRegistrasi = $config->registration_fee ?? 95000; 
        
        // 2. Logika Hitung Total Otomatis
        $sessions = $request->sessions ?? 4;
        $participants = $request->participants_count ?? 1;
        
        $sessionFactor = $sessions / 4;
        $participantFactor = 1 + (($participants - 1) * 0.5);
        
        // Rumus: $totalAmount = ((price * sessionFactor) * participantFactor) + biayaRegistrasi
        $totalAmount = (($subProgram->price * $sessionFactor) * $participantFactor) + $biayaRegistrasi;

        // 3. Mapping Data Siswa Lengkap
        $studentData = [];
        if ($request->has('student_names')) {
            foreach ($request->student_names as $index => $name) {
                $studentData[] = [
                    'nama_lengkap' => $name,
                    'panggilan' => $request->nicknames[$index] ?? '-',
                    'tgl_lahir' => $request->birth_dates[$index] ?? '-',
                    'gender' => $request->student_genders[$index] ?? '-'
                ];
            }
        }

        // 4. Simpan Transaksi
        $transaction = Transaction::create([
            'guest_name' => $request->student_names[0] ?? 'Calon Siswa',
            'guest_email' => 'tamu@bimbelinaja.com', 
            'program_id' => $subProgram->program_id,
            'sub_program_id' => $subProgram->id,
            'amount' => $totalAmount, 
            'status' => 'pending',
            'notes' => json_encode([
                'detail_siswa' => $studentData,
                'whatsapp' => $request->whatsapp,
                'kota_kabupaten' => $request->city,
                'alamat_lengkap' => $request->address,
                'preferensi_tutor' => $request->tutor_gender_pref,
                'tgl_mulai_les' => $request->start_date,
                'rencana_jadwal' => $request->schedule,
                'sifat_jadwal' => $request->schedule_type,
                'pesan_tambahan' => $request->additional_message,
                'paket_info' => [
                    'sesi' => $sessions,
                    'metode' => $request->learning_method,
                    'bahasa' => 'Indonesia',
                    'durasi' => '60 menit / sesi',
                    'biaya_registrasi' => $biayaRegistrasi
                ]
            ])
        ]);

        return redirect()->route('pembayaran.instruksi', $transaction->id);
    }

    /**
     * Ringkasan Pendaftaran
     */
    public function summary($id) {
        $transaction = Transaction::with(['subProgram.program'])->findOrFail($id);
        $details = json_decode($transaction->notes, true);
        $programs = Program::all(); 
        
        // PERBAIKAN: Selalu kirim object, bukan null
        $config = PaymentConfig::first() ?? new PaymentConfig();

        return view('student.summary', compact('transaction', 'details', 'programs', 'config'));
    }

    /**
     * Instruksi Pembayaran
     */
    public function instruction($id) {
        $transaction = Transaction::with('subProgram')->findOrFail($id);
        $programs = Program::all(); 
        
        // PERBAIKAN: Selalu kirim object, bukan null
        $config = PaymentConfig::first() ?? new PaymentConfig(); 

        return view('student.instruction', compact('transaction', 'programs', 'config'));
    }

    /**
     * Upload Bukti Pembayaran
     */
    public function uploadProof(Request $request, $id) {
        $request->validate(['proof_of_payment' => 'required|image|max:2048']);
        $transaction = Transaction::findOrFail($id);
        $path = $request->file('proof_of_payment')->store('proofs', 'public');
        $transaction->update(['proof_of_payment' => $path]);

        return redirect()->route('pembayaran.terkirim', $transaction->id);
    }

    /**
     * Halaman Konfirmasi Pembayaran Terkirim
     */
    public function pembayaranSelesai($id) {
        $transaction = Transaction::findOrFail($id);
        $programs = Program::all(); 

        return view('student.pembayaran-sukses', compact('transaction', 'programs'));
    }

    /**
     * Halaman Belajar (Setelah Verifikasi Sukses)
     */
    public function learningPage($transaction_id) {
        $transaction = Transaction::where('id', $transaction_id)->where('status', 'success')->first();
        if (!$transaction) {
            return redirect('/')->with('error', 'Akses ditolak. Admin belum memverifikasi pembayaran Anda.');
        }
        $subProgram = SubProgram::with(['items', 'questions'])->findOrFail($transaction->sub_program_id);
        $programs = Program::all(); 

        return view('student.learning', compact('subProgram', 'programs'));
    }

    /**
     * Kalkulator Biaya
     */
    public function kalkulator($id) {
        $subProgram = SubProgram::findOrFail($id);
        $programs = Program::all(); 
        
        // PERBAIKAN: Selalu kirim object, bukan null
        $config = PaymentConfig::first() ?? new PaymentConfig(); 

        return view('student.kalkulator', compact('subProgram', 'programs', 'config'));
    }

    /**
     * Menampilkan Invoice untuk Siswa (Web View)
     */
    public function viewInvoice($id) {
        $transaction = Transaction::with(['subProgram.program'])->findOrFail($id);
        $details = json_decode($transaction->notes, true);
        $config = PaymentConfig::first() ?? new PaymentConfig();

        return view('student.invoice', compact('transaction', 'details', 'config'));
    }

    /**
     * Men-generate PDF Invoice menggunakan dompdf
     */
    public function downloadInvoice($id) {
        $transaction = Transaction::with(['subProgram.program'])->findOrFail($id);
        $details = json_decode($transaction->notes, true);
        $config = PaymentConfig::first() ?? new PaymentConfig();

        // Load view invoice dan set ukuran kertas A4 portrait
        $pdf = Pdf::loadView('student.invoice', compact('transaction', 'details', 'config'))
                  ->setPaper('a4', 'portrait');

        // Men-download file PDF dengan nama Invoice-[ID].pdf
        return $pdf->download('Invoice-' . $transaction->id . '.pdf');
    }

    public function show(Transaction $transaction)
    {
        // Memuat data relasi program agar tidak error saat dipanggil di Blade
        $transaction->load('subProgram');
    
        return view('admin.transactions.show', compact('transaction'));
    }
}