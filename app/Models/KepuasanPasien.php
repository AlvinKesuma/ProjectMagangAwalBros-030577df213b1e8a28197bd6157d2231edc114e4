<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepuasanPasien extends Model
{
    use HasFactory;

    protected $table = 'kepuasan_pasien';

    protected $guarded = ['id'];
}
