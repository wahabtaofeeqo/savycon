<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $fillable = [
    	'name', 'email', 'message'
    ];
}
