<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentifikasiPemberianobat extends Model
{
    use HasFactory;

    protected $table = 'identifikasi_pemberianobat';

    protected $guarded = ['id'];
}
