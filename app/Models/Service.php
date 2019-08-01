<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'category_id'
    ];

    public function category()
    {
    	return $this->belongsTo('SavyCon\Models\Category');
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
