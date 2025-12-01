<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi: Pembayaran milik satu Tagihan
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    // Relasi: Pembayaran dilakukan oleh User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}