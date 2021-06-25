<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    use HasFactory;
    
    protected $table = 'community_user';

    protected $fillable = [
        'community_id',
        'user_id'
    ];
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'like', '%'.$value. '%');
    }
}
