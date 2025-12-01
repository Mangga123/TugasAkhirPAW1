<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi secara otomatis
    protected $fillable = ['role_name'];
}