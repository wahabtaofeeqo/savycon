<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillables = [
    	'title', 'description', 'URL', 'states', 'image', 'layer'
    ];
}
