<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackPelanggan extends Model
{
    use HasFactory;

    protected $table = 'feedback_pelanggan';

    protected $guarded = ['id'];
}
