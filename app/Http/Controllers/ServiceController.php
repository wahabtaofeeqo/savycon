<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;
use SavyCon\Models\Service;

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

    public function buyerServices()
    {
        $buyerServices = '';

        $user_requests = auth()->user()->userRequests;
        if (count($user_requests) > 0) {
            foreach ($user_requests as $request) {
                $buyerServices = UserService::where('title', 'LIKE', '%'.$request->title.'%')->where('city_id', $request->user->city_id)->paginate(10);
            }
        }

        return response($buyerServices, 200);
    }

    public function services($name, $id) {
        return Service::whereLike('name', $name, 'category_id', $id)->limit(10)->get();
    }
}