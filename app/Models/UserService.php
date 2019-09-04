<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image_1', 'image_2', 'image_3', 'featured', 'active', 'address', 'user_id', 'city_id', 'service_id'
    ];

    public function user()
    {
    	return $this->belongsTo('SavyCon\Models\User');
    }

    public function service()
    {
    	return $this->belongsTo('SavyCon\Models\Service');
    }

    public function city()
    {
        return $this->belongsTo('SavyCon\Models\City');
    }

    public function ratings()
    {
        return $this->hasMany('SavyCon\Models\UserServiceRating');
    }

    public function messages()
    {
        return $this->hasMany('SavyCon\Models\UserServiceMessage');
    }
}
