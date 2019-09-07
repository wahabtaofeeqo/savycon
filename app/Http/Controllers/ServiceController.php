<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;

class ServiceController extends Controller
{
    public function index()
    {
    	$services = UserService::inRandomOrder()->with([
    		'user',
    		'service',
    		'service.category',
            'city',
            'city.state'
    	])->where('active', 1)->paginate(20);

    	return response($services, 200);
    }

    public function featured()
    {
    	$services = UserService::inRandomOrder()->where('featured', '1')->with([
    		'user',
    		'service',
    		'service.category',
            'city',
            'city.state'
    	])->where('active', 1)->paginate(20);

    	return response($services, 200);
    }

    public function limitedFeatured($count)
    {
        $services = UserService::inRandomOrder()->where('featured', '1')->with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
        ])->where('active', 1)->limit($count)->get();

        return response($services, 200);
    }

    public function show($id)
    {
    	$service = UserService::with([
    		'user',
    		'service',
    		'service.category',
            'city',
            'city.state'
    	])->findOrFail($id);

    	return response($service, 200);
    }

    public function allServices()
    {
        $services = UserService::with([
            'city',
            'city.state'
        ])
        ->orderBy('title', 'ASC')->where('active', 1)->get();

        return response($services, 200);
    }
}
