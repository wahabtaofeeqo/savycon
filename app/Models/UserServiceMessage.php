<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class UserServiceMessage extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'message', 'user_service_id'
    ];
}
