<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianWaterIntrusion extends Model
{
    use HasFactory;

    protected $table = 'kejadian_water_intrusion';

    protected $guarded = ['id'];
}
