<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanIdentifikasi extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_identifikasi';

    protected $guarded = ['id'];
}
