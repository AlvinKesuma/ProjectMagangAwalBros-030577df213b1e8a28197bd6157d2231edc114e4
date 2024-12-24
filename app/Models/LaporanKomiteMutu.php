<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKomiteMutu extends Model
{
    use HasFactory;

    protected $table = 'laporan_komite_mutu';

    protected $guarded = ['id'];
}
