<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasienPemberianNutrisi extends Model
{
    use HasFactory;

    protected $table = 'pasien_pemberiannutrisi';

    protected $guarded = ['id'];
}
