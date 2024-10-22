<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbaikanStatusCVA extends Model
{
    use HasFactory;

    protected $table = 'perbaikan_status_cva';

    protected $guarded = ['id'];
}
