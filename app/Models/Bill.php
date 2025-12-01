<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Tagihan milik satu Resident
    public function resident()
    {
        return $this->belongsTo(Resident::class);
    }

    // Relasi: Tagihan bisa punya satu Pembayaran
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}