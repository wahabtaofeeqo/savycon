<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLink extends Model
{
    protected $fillable = [
        'uid', 'service', 'price', 'description', 'currency'
    ];
}
