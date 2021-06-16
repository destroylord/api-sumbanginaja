<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $table = 'communities';

    protected $fillable = [
        'name', 'images', 'banners', 'locations', 'descriptions'
    ];

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value. '%');
    }

    public function event()
    {
        return $this->hasOne(Event::class);
    }
}
