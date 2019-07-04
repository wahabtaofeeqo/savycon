<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
    ];

    public function cities()
    {
    	return $this->hasMany('SavyCon\Models\City');
    }

    public function users()
    {
    	return $this->hasManyThrough('SavyCon\Models\User', 'SavyCon\Models\City');
    }
}
