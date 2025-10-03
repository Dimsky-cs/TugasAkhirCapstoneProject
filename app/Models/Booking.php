<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'layanan', 'konselor', 'tanggal', 'waktu',
        'metode', 'nama', 'email', 'telepon'
    ];
}
