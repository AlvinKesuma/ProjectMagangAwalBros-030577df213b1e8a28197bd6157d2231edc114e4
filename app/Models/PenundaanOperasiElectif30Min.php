<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenundaanOperasiElectif30Min extends Model
{
    use HasFactory;

    protected $table = 'Penundaan_Operasi_Electif_30Min';

    protected $guarded = ['id'];
}
