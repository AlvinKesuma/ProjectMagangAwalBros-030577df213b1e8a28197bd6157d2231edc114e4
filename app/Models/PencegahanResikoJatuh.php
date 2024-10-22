<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PencegahanResikoJatuh extends Model
{
    use HasFactory;

    // Define the table if it's not following Laravel's convention
    protected $table = 'pencegahan_resikojatuh';

    // Fields that are mass assignable
    protected $guarded = ['id'];
}
