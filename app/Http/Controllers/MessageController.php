<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // 1. Tampilkan Daftar Pesan Masuk (INBOX)
    public function index()
    {
        // Ambil semua pesan yang receiver_id-nya adalah User yang sedang login
        $messages = Message::where('receiver_id', Auth::id())
                            ->with('sender') // Load data pengirim biar namanya muncul
                            ->latest()       // Urutkan dari yang terbaru
                            ->get();

        return view('messages.index', compact('messages'));
    }

    // 2. Baca Detail Pesan
    public function show($id)
    {
        // Cari pesan, pastikan yang buka adalah penerima yang sah
        $message = Message::where('id', $id)
                          ->where('receiver_id', Auth::id())
                          ->firstOrFail();

        // Tandai sudah dibaca
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('messages.show', compact('message'));
    }

    // 3. Tampilkan Form Buat Pesan (Khusus Dosen)
    public function create()
    {
        // Cek Double Security: Hanya Dosen yang boleh akses form ini
        if (Auth::user()->role !== 'dosen') {
            abort(403, 'Hanya Dosen yang boleh mengirim pesan.');
        }

        $dosen = User::where('role', 'dosen')->where('id', '!=', Auth::id())->get();
        
        $angkatan = User::where('role', 'mahasiswa')
                        ->select('angkatan')
                        ->distinct()
                        ->orderBy('angkatan', 'desc')
                        ->pluck('angkatan');

        return view('dosen.messages.create', compact('dosen', 'angkatan'));
    }

    // 4. Proses Kirim Pesan
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'target_type' => 'required|in:dosen,mahasiswa',
        ]);

        $sender_id = Auth::id();
        $target_ids = [];

        if ($request->target_type == 'dosen') {
            $request->validate(['dosen_ids' => 'required|array']);
            $target_ids = $request->dosen_ids;
        } elseif ($request->target_type == 'mahasiswa') {
            $query = User::where('role', 'mahasiswa');
            if ($request->angkatan && $request->angkatan != 'all') {
                $query->where('angkatan', $request->angkatan);
            }
            $target_ids = $query->pluck('id')->toArray();
            
            if (empty($target_ids)) {
                return back()->withErrors(['msg' => 'Tidak ada mahasiswa ditemukan.']);
            }
        }

        foreach ($target_ids as $receiver_id) {
            Message::create([
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'subject' => $request->subject,
                'content' => $request->content,
                'is_read' => false,
            ]);
        }

        return redirect()->route('dosen.dashboard')->with('success', 'Pesan berhasil dikirim!');
    }
}