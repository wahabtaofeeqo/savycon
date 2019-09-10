<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\User;
use SavyCon\Models\UserService;
use SavyCon\Models\City;
use SavyCon\Models\State;
use SavyCon\Models\Search;

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

            if (isset($city)) {
                $services = $this->appendCityStructure($city, $text, $address);
            } else {
                $services = UserService::with([
                        'user',
                        'service',
                        'service.category',
                        'city',
                        'city.state'
                    ])
                    ->where([
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
        $services = UserService::with([
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
        ->get();

        return response($services, 200);
    }

    private function collectSearch($text = null)
    {
        return $services = UserService::with([
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

    private function appendCityStructure(City $city, $text, $address)
    {
        $services = UserService::with([
                'user',
                'service',
                'service.category',
                'city',
                'city.state'
            ])
            ->where([
                ['address', 'LIKE', '%'.$address.'%'],
                ['city_id', $city->id],
                ['title', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->orWhere([
                ['address', 'LIKE', '%'.$address.'%'],
                ['description', 'LIKE', '%'.$text.'%'],
                ['active', '1'],
            ])
            ->paginate(20);

        return $services;
    }
}
