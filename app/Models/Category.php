<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    public function services()
    {
    	return $this->hasMany('SavyCon\Models\Service');
    }

    public function userServices()
    {
    	return $this->hasManyThrough('SavyCon\Models\UserService', 'SavyCon\Models\Service');
    }
}
