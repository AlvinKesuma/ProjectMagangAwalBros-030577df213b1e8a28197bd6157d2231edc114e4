<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LOSgagalJantungAkut extends Model
{
    use HasFactory;

    protected $table = 'los_gagal_jantung_akut';

    protected $guarded = ['id'];
}
