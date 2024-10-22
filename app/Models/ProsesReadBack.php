<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesReadBack extends Model
{
    use HasFactory;

    protected $table = 'proses_readback';

    protected $guarded = ['id'];
}
