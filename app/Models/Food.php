<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'images',
        'status',
        'food_generate_code',
        'descriptions',
        'payback_time',
        'province_id',
        'city_id',
        'address'
    ];

    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%' . $value . '%');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ratings()
    {
        return $this->belongsToMany(Rating::class);
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
