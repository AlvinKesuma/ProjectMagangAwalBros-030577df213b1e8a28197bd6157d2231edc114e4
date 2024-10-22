<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanFormulariumNasional extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_formularium_nasional';

    protected $guarded = ['id'];
}
