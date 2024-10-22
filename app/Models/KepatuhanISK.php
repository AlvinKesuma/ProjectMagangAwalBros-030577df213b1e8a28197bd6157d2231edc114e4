<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanISK extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_isk';

    protected $guarded = ['id'];
}
