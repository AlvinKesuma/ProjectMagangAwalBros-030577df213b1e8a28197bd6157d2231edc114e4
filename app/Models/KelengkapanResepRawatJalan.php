<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelengkapanResepRawatJalan extends Model
{
    use HasFactory;

    protected $table = 'kelengkapan_resep_rawat_jalan';

    protected $guarded = ['id'];
}
