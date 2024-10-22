<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaktuTungguRawatJalanUnder30Min extends Model
{
    use HasFactory;

    protected $table = 'waktu_tunggu_rawat_jalan_under30min';

    protected $guarded = ['id'];
}
