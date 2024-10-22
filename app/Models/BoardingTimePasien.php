<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardingTimePasien extends Model
{
    use HasFactory;

    protected $table = 'boarding_timepasien';

    protected $guarded = ['id'];
}
