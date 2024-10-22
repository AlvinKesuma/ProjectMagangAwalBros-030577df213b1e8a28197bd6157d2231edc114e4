<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanVisitDokterSpesialis extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_visit_dokter_spesialis';

    protected $guarded = ['id'];
}
