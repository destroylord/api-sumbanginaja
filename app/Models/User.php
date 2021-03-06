<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.`
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_users',
        'type',
        'no_handphone',
        'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function community()
    {
        return $this->hasOne(Community::class);
    }

    public function communities()
    {
        return $this->belongsToMany(Community::class, 'community_user','community_id','user_id');
    }

}
