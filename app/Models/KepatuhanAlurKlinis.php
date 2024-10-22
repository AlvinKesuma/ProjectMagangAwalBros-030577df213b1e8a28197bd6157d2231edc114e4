<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepatuhanAlurKlinis extends Model
{
    use HasFactory;

    protected $table = 'kepatuhan_alur_klinis';

    protected $guarded = ['id'];
}
