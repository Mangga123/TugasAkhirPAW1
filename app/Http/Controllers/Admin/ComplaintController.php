<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Admin melihat semua laporan
    public function index()
    {
        $complaints = Complaint::with('resident.user', 'resident.unit')->latest()->paginate(10);
        return view('admin.complaints.index', compact('complaints'));
    }

    // Admin update status (Pending -> Proses -> Selesai)
    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'status' => 'required|in:Pending,Proses,Selesai'
        ]);

        $complaint->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui!');
    }
}