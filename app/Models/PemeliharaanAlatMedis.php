<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeliharaanAlatMedis extends Model
{
    use HasFactory;

    protected $table = 'pemeliharaan_alat_medis';

    protected $guarded = ['id'];
}
