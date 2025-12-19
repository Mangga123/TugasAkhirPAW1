<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    // Pastikan 'content' ada di sini, BUKAN 'body'
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'subject',
        'content', // <--- INI PENTING (Sesuaikan dengan nama kolom DB)
        'status',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}