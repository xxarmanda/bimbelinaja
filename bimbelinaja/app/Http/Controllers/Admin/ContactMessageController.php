<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Untuk Siswa mengirim pesan
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        ContactMessage::create($data);
        return redirect()->back()->with('success', 'Pesan Anda telah terkirim! Admin kami akan segera menghubungi Anda. ✨');
    }

    // Untuk Admin melihat daftar pesan
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        // OTOMATIS: Tandai semua pesan sebagai 'sudah dibaca' saat halaman dibuka
        ContactMessage::where('is_read', false)->update(['is_read' => true]);

        return view('admin.messages.index', compact('messages'));
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();
        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}