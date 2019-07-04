<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\State;
use SavyCon\Models\City;

class LocationController extends Controller
{
    public function states()
    {
    	return response(State::all(), 200);
    }

    public function cities($id)
    {
    	$cities = State::findOrFail($id)->cities;

    	return response($cities, 200);
    }
}
