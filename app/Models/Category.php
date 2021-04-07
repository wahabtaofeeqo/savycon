<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'image_tag'
    ];

    public function services()
    {
    	return $this->hasMany('SavyCon\Models\Service');
    }

    public function userServices()
    {
    	return $this->hasManyThrough('SavyCon\Models\UserService', 'SavyCon\Models\Service');
    }

    public function scopeWhereLike($query, $column, $value) {
        return $query->where($column, 'LIKE', "%$value%");
    }
}