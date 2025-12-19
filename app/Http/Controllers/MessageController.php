<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // 1. INBOX (KOTAK MASUK)
    public function index()
    {
        $messages = Message::where('receiver_id', Auth::id())
                            ->with('sender')
                            ->latest()
                            ->get();

        return view('messages.index', compact('messages'));
    }

    // 2. HALAMAN BUAT PESAN
    public function create()
    {
        // Ambil angkatan untuk dropdown filter (Khusus Dosen)
        $angkatans = User::where('role', 'mahasiswa')
                         ->whereNotNull('angkatan')
                         ->distinct()
                         ->orderBy('angkatan', 'desc')
                         ->pluck('angkatan');

        return view('messages.create', compact('angkatans'));
    }

    // 3. PROSES KIRIM PESAN (INI YANG KITA PERBAIKI)
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'body' => 'required|string', // Di Form namanya 'body'
            'receiver_role' => 'required|string',
            'angkatan' => 'nullable|string',
        ]);

        $senderId = Auth::id();

        // A. JIKA MEMILIH ORANG SPESIFIK
        if ($request->receiver_id) {
            Message::create([
                'sender_id' => $senderId,
                'receiver_id' => $request->receiver_id,
                'subject' => $request->subject,
                
                // PERBAIKAN DISINI:
                // Input 'body' dari form -> Masuk ke kolom 'content' di Database
                'content' => $request->body, 
                
                'status' => 'unread',
            ]);
            $count = 1;

        } else {
            // B. JIKA BROADCAST
            $query = User::where('role', $request->receiver_role)
                         ->where('id', '!=', $senderId);

            if ($request->receiver_role == 'mahasiswa' && $request->filled('angkatan')) {
                $query->where('angkatan', $request->angkatan);
            }

            $receivers = $query->get();

            foreach ($receivers as $receiver) {
                Message::create([
                    'sender_id' => $senderId,
                    'receiver_id' => $receiver->id,
                    'subject' => $request->subject,
                    
                    // PERBAIKAN DISINI JUGA:
                    'content' => $request->body, 
                    
                    'status' => 'unread',
                ]);
            }
            $count = $receivers->count();
        }

        return redirect()->route('dosen.dashboard')
            ->with('success', "Pesan berhasil dikirim ke $count orang!");
    }

    // 4. PESAN TERKIRIM
    public function sent()
    {
        $messages = Message::where('sender_id', Auth::id())
                            ->with('receiver')
                            ->latest()
                            ->get();

        return view('messages.sent', compact('messages'));
    }

    // 5. BACA PESAN
    public function show($id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id !== Auth::id() && $message->sender_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak membaca pesan ini.');
        }

        if ($message->receiver_id === Auth::id() && $message->status === 'unread') {
            $message->update(['status' => 'read']);
        }

        return view('messages.show', compact('message'));
    }

    // 6. UPDATE STATUS (Untuk Mahasiswa: Berlangsung/Selesai)
    public function updateStatus(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        if ($message->receiver_id == Auth::id()) {
            $message->update(['status' => $request->status]);
            return response()->json(['success' => true]);
        }
        
        return response()->json(['success' => false], 403);
    }

    // 7. HAPUS PESAN
    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        
        if ($message->receiver_id == Auth::id() || $message->sender_id == Auth::id()) {
            $message->delete();
            return back()->with('success', 'Pesan berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus pesan.');
    }

    // 8. HAPUS SEMUA (Inbox)
    public function destroyAll()
    {
        Message::where('receiver_id', Auth::id())->delete();
        return back()->with('success', 'Semua pesan masuk telah dihapus.');
    }
}