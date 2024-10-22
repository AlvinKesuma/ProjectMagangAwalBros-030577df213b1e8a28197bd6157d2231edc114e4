<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuTanggapSeksiSesarea extends Model
{
    use HasFactory;

    protected $table = 'waktu_tanggap_seksi_sesarea';

    protected $guarded = ['id'];
}
