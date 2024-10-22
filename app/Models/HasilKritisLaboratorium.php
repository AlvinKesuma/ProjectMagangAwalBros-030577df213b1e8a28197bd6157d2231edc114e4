<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilKritisLaboratorium extends Model
{
    use HasFactory;

    protected $table = 'hasil_kritislaboratorium';

    protected $guarded = ['id'];
}
