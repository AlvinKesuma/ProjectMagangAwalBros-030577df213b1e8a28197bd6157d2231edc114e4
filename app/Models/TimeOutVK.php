<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeOutVK extends Model
{
    use HasFactory;

    protected $table = 'timeout_vk';

    protected $guarded = ['id'];
}