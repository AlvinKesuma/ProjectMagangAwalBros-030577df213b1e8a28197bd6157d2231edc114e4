<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperatorDaerahOperasi extends Model
{
    use HasFactory;

    protected $table = 'operator_daerahoperasi';

    protected $guarded = ['id'];
}
