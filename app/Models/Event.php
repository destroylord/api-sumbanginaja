<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'images', 
        'locations', 
        'descriptions', 
        'community_id',
        'status',
        'event_generate_code'
    ];

    public function community()
    {
        return $this->belongsTo(Community::class);
    }
}
