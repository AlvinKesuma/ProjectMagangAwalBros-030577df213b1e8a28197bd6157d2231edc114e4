<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasCuciTangan extends Model
{
    use HasFactory;

    protected $table = 'petugas_cucitangan';

    protected $guarded = ['id'];
}
