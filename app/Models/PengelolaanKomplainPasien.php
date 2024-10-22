<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaanKomplainPasien extends Model
{
    use HasFactory;

    protected $table = 'pengelolaan_komplain_pasien';

    protected $guarded = ['id'];
}
