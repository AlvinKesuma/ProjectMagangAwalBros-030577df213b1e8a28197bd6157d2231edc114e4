<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanIDO extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_ido';

    protected $guarded = ['id'];
}
