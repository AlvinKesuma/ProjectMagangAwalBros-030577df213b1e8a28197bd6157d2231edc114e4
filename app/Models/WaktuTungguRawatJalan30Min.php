<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuTungguRawatJalan30Min extends Model
{
    use HasFactory;

    protected $table = 'waktu_tunggu_rawat_jalan_30min';

    protected $guarded = ['id'];
}
