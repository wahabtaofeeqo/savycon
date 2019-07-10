<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\State;
use SavyCon\Models\City;

class LocationController extends Controller
{
    public function states()
    {
    	return response(State::orderBy('name', 'ASC')->get(), 200);
    }

    public function cities($id)
    {
    	$cities = State::findOrFail($id)->cities()->orderBy('name', 'ASC')->get();

    	return response($cities, 200);
    }
}
