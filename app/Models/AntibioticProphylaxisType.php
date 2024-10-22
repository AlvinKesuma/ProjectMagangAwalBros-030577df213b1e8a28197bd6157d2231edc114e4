<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AntibioticProphylaxisType extends Model
{
    use HasFactory;

    protected $table = 'antibiotic_prophylaxistype';

    protected $guarded = ['id'];
}
