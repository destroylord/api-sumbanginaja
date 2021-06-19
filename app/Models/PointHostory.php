<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointHostory extends Model
{
    use HasFactory;

    protected $table = 'point_hostories';

    protected $fillable = [
        'user_id',
        'type',
        'qty',
    ];
}
