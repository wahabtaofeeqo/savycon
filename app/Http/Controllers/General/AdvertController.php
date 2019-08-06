<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\Advert;

class AdvertController extends Controller
{
    public function dashboard($limit)
    {
    	$adverts = Advert::inRandomOrder()->where('layer', 'all')->orWhere('layer', 'dashboard')->limit($limit)->get();

    	return response($adverts, 200);
    }
}
