<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Relasi: Unit bisa ditempati oleh satu Resident aktif.
     */
    public function resident()
    {
        return $this->hasOne(Resident::class)->where('status', 'Aktif');
    }
}