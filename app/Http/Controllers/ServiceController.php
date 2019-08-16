<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;
use SavyCon\Models\Search;

class ServiceController extends Controller
{
    public function index()
    {
    	$services = UserService::inRandomOrder()->with([
    		'user',
    		'service',
    		'service.category'
    	])->where('active', 1)->paginate(20);

    	return response($services, 200);
    }

    public function featured()
    {
    	$services = UserService::inRandomOrder()->where('featured', '1')->with([
    		'user',
    		'service',
    		'service.category'
    	])->where('active', 1)->paginate(20);

    	return response($services, 200);
    }

    public function limitedFeatured($count)
    {
        $services = UserService::inRandomOrder()->where('featured', '1')->with([
            'user',
            'service',
            'service.category'
        ])->where('active', 1)->limit($count)->get();

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
                ['active', '1'],
            ])
            ->orWhere([
                ['address', 'LIKE', '%'.$address.'%'],
                ['description', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->paginate(20);
        } else {
            $services = UserService::where([
                ['title', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->orWhere([
                ['description', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->paginate(20);
        }

        if (empty($service->data)) {
            $unfound = new Search();
            $unfound->text = $text;

            if ($address) {
                $unfound->address = $address;
            }

            $unfound->save();
        }

        return response($services, 200);
    }

    public function allServices()
    {
        $services = UserService::orderBy('title', 'ASC')->where('active', 1)->get();

        return response($services, 200);
    }
}
