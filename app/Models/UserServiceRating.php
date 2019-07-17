<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class UserServiceRating extends Model
{
    protected $fillable = [
        'user_service_id', 'user_id', 'stars', 'comment',
    ]; 

    public function user()
    {
    	return $this->belongsTo('SavyCon\Models\User');
    }

    public function userService()
    {
    	return $this->belongsTo('SavyCon\Models\UserService');
    }
}
