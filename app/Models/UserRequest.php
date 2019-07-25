<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    protected $fillable = [
        'title', 'description', 'price', 'address', 'user_id', 'service_id'
    ];

    public function user()
    {
    	return $this->belongsTo('SavyCon\Models\User');
    }

    public function service()
    {
    	return $this->belongsTo('SavyCon\Models\Service');
    }
}
