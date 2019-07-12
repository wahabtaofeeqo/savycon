<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;

class ServiceController extends Controller
{
    public function index()
    {
    	$services = UserService::with([
    		'user',
    		'service',
    		'service.category'
    	])->latest()->paginate(15);

    	return response($services, 200);
    }

    public function featured()
    {
    	$services = UserService::where('featured', '1')->with([
    		'user',
    		'service',
    		'service.category'
    	])->latest()->paginate(20);

    	return response($services, 200);
    }

    public function show($id)
    {
    	$services = UserService::findOrFail($id)->with([
    		'user',
    		'service',
    		'service.category'
    	])->first();

    	return response($services, 200);
    }
}
