<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi: Resident adalah seorang User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Resident menempati satu Unit.
     */
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * Relasi: Resident punya banyak keluhan (Complaints).
     */
    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

    /**
     * Relasi: Resident punya banyak Tagihan (Bills).
     * (INI YANG BARU DITAMBAHKAN)
     */
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
}