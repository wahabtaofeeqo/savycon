<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class UserService extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'image_1', 'image_2', 'image_3', 'featured', 'user_id', 'service_id'
    ];

    public function user()
    {
    	return $this->belongsTo('SavyCon\Models\User');
    }

    public function service()
    {
    	return $this->belongsTo('SavyCon\Models\Service');
    }

    public function ratings()
    {
        return $this->hasMany('SavyCon\Models\UserServiceRating');
    }
}
