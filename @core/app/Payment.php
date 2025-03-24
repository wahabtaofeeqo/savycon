<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillables = [
    	'transaction_id', 'reference', 
        'user_id', 'service_id', 'type', 'amount'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function service()
    {
    	return $this->belongsTo(Service::class);
    }
}
