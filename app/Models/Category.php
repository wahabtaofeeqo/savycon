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
}
