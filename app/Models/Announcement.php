<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'content', 
        'sender_id', 
        'target_department_id', 
        'target_angkatan'
    ];

    // Relasi: Pengumuman ini milik 1 Pengirim (User)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi: Pengumuman ini ditujukan ke 1 Prodi (Opsional)
    public function targetDepartment()
    {
        return $this->belongsTo(Department::class, 'target_department_id');
    }
}