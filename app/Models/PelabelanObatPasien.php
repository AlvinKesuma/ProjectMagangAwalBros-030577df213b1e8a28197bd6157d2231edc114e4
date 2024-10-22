<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelabelanObatPasien extends Model
{
    use HasFactory;

    protected $table = 'pelabelan_obatpasien';

    protected $guarded = ['id'];
}
