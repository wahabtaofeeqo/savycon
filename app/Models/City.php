<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name', 'state_id'
    ];

    public function users()
    {
    	return $this->hasMany('SavyCon\Models\User');
    }

    public function state()
    {
    	return $this->belongsTo('SavyCon\Models\State');
    }

    public function userRequests()
    {
        return $this->hasManyThrough('SavyCon\Models\UserRequest', 'SavyCon\Models\User');
    }

    public function userServices()
    {
        return $this->hasMany('SavyCon\Models\UserService');
    }
}
