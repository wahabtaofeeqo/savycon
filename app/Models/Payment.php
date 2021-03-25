<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillables = [
    	'transaction_id', 'reference', 'user_id', 'user_service_id', 'type', 'package', 'amount'
    ];

    public function user()
    {
    	return $this->belongsTo('SavyCon\Models\User');
    }

    public function userService()
    {
    	return $this->belongsTo('SavyCon\Models\Service');
    }
}
