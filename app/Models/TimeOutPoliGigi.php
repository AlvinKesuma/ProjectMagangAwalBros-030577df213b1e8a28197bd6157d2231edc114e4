<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOutPoliGigi extends Model
{
    use HasFactory;

    protected $table = 'timeout_poligigi';

    protected $guarded = ['id'];
}