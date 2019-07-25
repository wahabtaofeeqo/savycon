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
    		'service.category'
    	])->latest()->paginate(15);

    	return response($services, 200);
    }

    public function featured()
    {
    	$services = UserService::inRandomOrder()->where('featured', '1')->with([
    		'user',
    		'service',
    		'service.category'
    	])->latest()->paginate(20);

    	return response($services, 200);
    }

    public function limitedFeatured($count)
    {
        $services = UserService::inRandomOrder()->where('featured', '1')->with([
            'user',
            'service',
            'service.category'
        ])->latest()->limit($count)->get();

        return response($services, 200);
    }

    public function show($id)
    {
    	$service = UserService::with([
    		'user',
    		'service',
    		'service.category'
    	])->findOrFail($id);

    	return response($service, 200);
    }

    public function search($text = null, $address = null)
    {
        if ($address) {
            $services = UserService::where([
                    ['address', 'LIKE', '%'.$address.'%'],
                    ['title', 'LIKE', '%'.$text.'%'],
                    ['description', 'LIKE', '%'.$text.'%'],
                ])
                ->paginate(15);
        } else {
            $services = UserService::where('title', 'LIKE', '%'.$text.'%')
                ->orWhere('description', 'LIKE', '%'.$text.'%')
                ->paginate(15);
        }

        return response($services, 200);
    }
}
