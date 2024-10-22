<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuTungguRawatJalanUp60Min extends Model
{
    use HasFactory;

    protected $table = 'waktu_tunggu_rawat_jalan_up60min';

    protected $guarded = ['id'];
}
