<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\User;
use SavyCon\Models\UserService;
use SavyCon\Models\City;
use SavyCon\Models\State;
use SavyCon\Models\Search;
use SavyCon\Models\Category;

class SearchController extends Controller
{
    public function search($text = null, $address = null)
    {
        $notfound = 0;

        if (!is_null($address)) {
        	if (strpos($address, ',')) {
        		$address = explode(',', $address)[0];
        	}

            $city = City::where('name', $address)->first();
            $state = State::where('name', $address)->first();

            if (!empty($state)) {
                $services = $state->userServices()
                    ->where('active', 1)
                    ->where('description', 'LIKE', '%'.$text.'%')
                    ->with('user', 'service', 'service.category', 'city', 'city.state')
                    ->paginate(20);
            }
            else if (!empty($city)) {
                $category = Category::where('name', $text)->first();
                
                if (!empty($category)) {
                    $services = $category->userServices()
                        ->where('active', 1)
                        ->where('city_id', $city->id)
                        ->where('description', 'LIKE', '%'.$text.'%')
                        ->with('user', 'service', 'service.category', 'city', 'city.state')
                        ->paginate(20);
                } else {
                    $services = $city->userServices()
                        ->where('active', 1)
                        ->where('description', 'LIKE', '%'.$text.'%')
                        ->with('user', 'service', 'service.category', 'city', 'city.state')
                        ->paginate(20);
                }
            } 
            else {
                $services = UserService::with([
                        'user',
                        'service',
                        'service.category',
                        'city',
                        'city.state'
                    ])->where([
                        ['title', 'LIKE', '%'.$text.'%'],
                        ['address', 'LIKE', '% '.$address.' %'],
                        ['active', '1'],
                    ])
                    ->orWhere([
                        ['description', 'LIKE', '%'.$text.'%'],
                        ['address', 'LIKE', '% '.$address.' %'],
                        ['active', '1'],
                    ])
                    ->paginate(20);
            }
        } 
        else {
            $services = $this->collectSearch($text);
        }

        if (!count($services)) {
            $notfound = 1;

            $unfound = new Search();
            $unfound->text = $text;

            if ($address) {
                $services = $this->collectSearch($text);
                $unfound->address = $address;
            }

            $unfound->save();
        }

        return response([
            'services' => $services,
            'notfound' => $notfound
        ], 200);
    }

    public function adminSearch($text = null)
    {
        $services = UserService::with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
        ])
        ->where([
            ['title', 'LIKE', '%'.$text.'%'],
        ])
        ->latest()
        ->paginate(20);

        return response($services, 200);
    }

    public function adminSearchVendor($text = null)
    {
        $vendors = User::withCount([
            'userServices'
        ])
        ->with([
            'city',
            'city.state'
        ])
        ->where([
            ['role', 'vendor'],
            ['name', 'LIKE', '%'.$text.'%'],
        ])
        ->orWhere([
            ['role', 'vendor'],
            ['email', 'LIKE', '%'.$text.'%'],
        ])
        ->latest()
        ->paginate(10);

        return response($vendors, 200);
    }

    public function suggestSearch($text = null)
    {
        $categories = Category::where('name', 'LIKE', '%'.$text.'%')->distinct()->get();

        return response($categories, 200);
    }

    public function suggestLocation($location = null)
    {
        $locations = City::where('name', 'LIKE', '% '.$location.' %')
        ->orWhere('name', 'LIKE', ''.$location.' %')
        ->orWhere('name', 'LIKE', '% '.$location.'')
        ->orWhere('name', 'LIKE', '%'.$location.'%')
        ->distinct()
        ->get();

        if (!count($locations)) {
            $locations = State::where('name', 'LIKE', '% '.$location.' %')
            ->orWhere('name', 'LIKE', ''.$location.' %')
            ->orWhere('name', 'LIKE', '% '.$location.'')
            ->orWhere('name', 'LIKE', '%'.$location.'%')
            ->distinct()
            ->get();
        }

        return response($locations, 200);
    }

    private function collectSearch($text = null)
    {
        return UserService::with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
            ])->where([
                ['title', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->orWhere([
                ['description', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->paginate(20);
    }
}
