<?php

namespace SavyCon\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    protected $fillable = [
        'category', 'content', 'description', 'phonenumber', 'whatsapp', 'subcategory'
    ];

    protected $table = 'servicepage';
}