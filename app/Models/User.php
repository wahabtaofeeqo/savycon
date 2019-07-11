<?php

namespace SavyCon\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'city_id', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRole()
    {
        return $this->role;
    }

    public function city()
    {
        return $this->belongsTo('SavyCon\Models\City');
    }

    public function state()
    {
        return $this->belongsTo('SavyCon\Models\State');
    }

    public function userServices()
    {
        return $this->hasMany('SavyCon\Models\UserService');
    }

    public function userRequests()
    {
        return $this->hasMany('SavyCon\Models\UserRequest');
    }
}
