<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $fillable = [
        'text', 'address'
    ];
}
