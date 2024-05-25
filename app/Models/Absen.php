<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $table = 'absen';

    protected $fillable  = [
        'nama','tamu_keluarga','kenal_dari','instansi','status_tamu','status_hadir'
    ];
}
