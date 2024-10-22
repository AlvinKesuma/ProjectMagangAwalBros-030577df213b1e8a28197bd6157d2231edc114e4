<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeknikSBARPerawat extends Model
{
    use HasFactory;

    // Define the table if it's not following Laravel's convention
    protected $table = 'tekniksbar_perawat';

    // Fields that are mass assignable
    protected $guarded = ['id'];
}
