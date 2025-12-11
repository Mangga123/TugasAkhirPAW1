<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Kolom mana saja yang boleh diisi datanya
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'content',
        'is_read',
    ];

    // Relasi: Pesan ini milik Pengirim (User)
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // Relasi: Pesan ini milik Penerima (User)
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}