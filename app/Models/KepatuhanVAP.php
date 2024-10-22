<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanVAP extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_vap';

    protected $guarded = ['id'];
}
