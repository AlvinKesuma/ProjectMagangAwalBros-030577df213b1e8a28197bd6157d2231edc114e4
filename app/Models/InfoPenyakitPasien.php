<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPenyakitPasien extends Model
{
    use HasFactory;

    protected $table = 'info_penyakitpasien';

    protected $guarded = ['id'];
}
