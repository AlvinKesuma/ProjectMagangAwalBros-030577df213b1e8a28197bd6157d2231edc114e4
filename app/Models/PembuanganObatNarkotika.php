<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembuanganObatNarkotika extends Model
{
    use HasFactory;

    protected $table = 'pembuangan_obatnarkotika';

    protected $guarded = ['id'];
}
