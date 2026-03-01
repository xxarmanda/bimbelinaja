<?php

namespace App\Http\Controllers;

use App\Models\Program; 
use App\Models\SubProgram;
use App\Models\Transaction;
use App\Models\PaymentConfig; 
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentTransactionController extends Controller
{
    /**
     * Menampilkan Halaman Checkout
     */
    public function checkout($id) {
        $program = SubProgram::with('program')->findOrFail($id);
        $programs = Program::all(); 
        $settings = Setting::pluck('value', 'key')->all();
        
        return view('student.checkout', compact('program', 'programs', 'settings'));
    }

    /**
     * Menyimpan Data Transaksi (Manual Payment)
     */
    public function store(Request $request) {
        $subProgram = SubProgram::findOrFail($request->sub_program_id);
        
        // 1. AMBIL BIAYA REGISTRASI DINAMIS
        $settings = Setting::pluck('value', 'key')->all();
        $regFee = (int)($settings['reg_fee'] ?? 95000);
        
        // 2. LOGIKA HITUNG TOTAL (Sesuai kode asli kamu)
        $sessions = $request->sessions ?? 4;
        $participants = $request->participants_count ?? 1;
        $sessionFactor = $sessions / 4;
        $participantFactor = 1 + (($participants - 1) * 0.5);
        
        $totalAmount = (($subProgram->price * $sessionFactor) * $participantFactor) + $regFee;

        // 3. Mapping Data Siswa
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

        // 4. Simpan Transaksi (Status: Pending)
        $transaction = Transaction::create([
            'guest_name' => $request->student_names[0] ?? 'Calon Siswa',
            'guest_email' => $request->guest_email ?? 'tamu@bimbelinaja.com', 
            'program_id' => $subProgram->program_id,
            'sub_program_id' => $subProgram->id,

            // ✅ TAMBAHKAN INI
            'learning_method' => $request->learning_method,
            'sessions' => $sessions,

            'amount' => $totalAmount, 
            'status' => 'pending',
            'notes' => json_encode([
                'detail_siswa' => $studentData,
                'whatsapp' => $request->whatsapp,
                'kota_kabupaten' => $request->city,
                'alamat_lengkap' => $request->address,
                'paket_info' => [
                    'sesi' => $sessions,
                    'metode' => $request->learning_method,
                    'biaya_registrasi' => $regFee
                ]
            ])
        ]);
        return redirect()->route('pembayaran.instruksi', $transaction->id);
    }

    /**
     * Upload Bukti Manual (Langsung ke folder Public agar aman di cPanel)
     */
    public function uploadProof(Request $request, $id) {
        $request->validate(['proof_of_payment' => 'required|image|max:2048']);
        $transaction = Transaction::findOrFail($id);

        if ($request->hasFile('proof_of_payment')) {
            $file = $request->file('proof_of_payment');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Pindahkan langsung ke folder public/uploads/proofs
            $file->move(public_path('uploads/proofs'), $filename);

            $transaction->update([
                'proof_of_payment' => 'uploads/proofs/' . $filename
            ]);
        }

        return redirect()->route('pembayaran.terkirim', $transaction->id);
    }

    /**
     * Halaman Instruksi Pembayaran (Menampilkan Rekening Manual)
     */
    public function instruction($id) {
        $transaction = Transaction::with('subProgram')->findOrFail($id);
        $programs = Program::all(); 
        $settings = Setting::pluck('value', 'key')->all();
        $config = PaymentConfig::first() ?? new PaymentConfig(); 

        return view('student.instruction', compact('transaction', 'programs', 'config', 'settings'));
    }

    /**
     * Ringkasan & Fitur Lainnya
     */
    public function summary($id) {
        $transaction = Transaction::with(['subProgram.program'])->findOrFail($id);
        $details = json_decode($transaction->notes, true);
        $programs = Program::all(); 
        $settings = Setting::pluck('value', 'key')->all();
        $config = PaymentConfig::first() ?? new PaymentConfig();

        return view('student.summary', compact('transaction', 'details', 'programs', 'config', 'settings'));
    }

    public function downloadInvoice($id) {
        $transaction = Transaction::with(['subProgram.program'])->findOrFail($id);
        $details = json_decode($transaction->notes, true);
        $settings = Setting::pluck('value', 'key')->all();
        $config = PaymentConfig::first() ?? new PaymentConfig();

        $pdf = Pdf::loadView('student.invoice', compact('transaction', 'details', 'config', 'settings'))
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Invoice-' . $transaction->id . '.pdf');
    }

    public function pembayaranSelesai($id) {
        $transaction = Transaction::findOrFail($id);
        $programs = Program::all(); 
        return view('student.pembayaran-sukses', compact('transaction', 'programs'));
    }

    public function learningPage($transaction_id) {
        $transaction = Transaction::where('id', $transaction_id)->where('status', 'success')->first();
        if (!$transaction) {
            return redirect('/')->with('error', 'Akses ditolak. Hubungi Admin untuk verifikasi pembayaran.');
        }
        $subProgram = SubProgram::with(['items', 'questions'])->findOrFail($transaction->sub_program_id);
        $programs = Program::all(); 
        return view('student.learning', compact('subProgram', 'programs'));
    }

    public function show(Transaction $transaction) {
        $transaction->load('subProgram.program');
        return view('admin.transactions.show', compact('transaction'));
    }

    public function kalkulator($id)
    {
        $subProgram = SubProgram::with('program')->findOrFail($id);
        $programs = Program::all(); // Tambahkan ini agar navbar tidak eror
        
        return view('student.kalkulator', compact('subProgram', 'programs'));
    }

    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return redirect()->route('admin.transactions.index')
            ->with('success','Data pendaftar berhasil dihapus.');
    }
}