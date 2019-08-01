<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\State;
use SavyCon\Models\City;
use SavyCon\Models\Category;
use SavyCon\Models\Service;
use SavyCon\Models\User;
use SavyCon\Models\Subscription;
use SavyCon\Models\UserRequest;
use SavyCon\Models\UserService;
use SavyCon\Models\UserServiceMessage;
use SavyCon\Models\ContactEnquiry;
use SavyCon\Models\Search;

class CounterController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:api');
	}

    public function totalStates()
    {
    	return State::count();
    }

    public function totalCities()
    {
    	return City::count();
    }

    public function totalCategories()
    {
    	return Category::count();
    }

    public function totalSubCategories()
    {
    	return Service::count();
    }

    public function totalServices()
    {
    	return UserService::count();
    }

    public function featuredServices()
    {
    	return UserService::where('featured', 1)->count();
    }

    public function bannedServices()
    {
    	return UserService::where('active', 0)->count();
    }

    public function totalVendors()
    {
    	return User::where('role', 'vendor')->count();
    }

    public function suspendedVendors()
    {
    	return User::where([
    		['role', 'vendor'],
    		['active', 0]
    	])->count();
    }

    public function totalBuyers()
    {
    	return User::where('role', 'user')->count();
    }

    public function totalSubscribers()
    {
    	return Subscription::count();
    }

    public function totalContactMessages()
    {
    	return ContactEnquiry::count();
    }

    public function totalVendorMessages()
    {
    	return UserServiceMessage::count();
    }

    public function totalUnfoundSearches()
    {
    	return Search::count();
    }

    public function totalBuyerRequests()
    {
    	return UserRequest::count();
    }

    public function totalVendorServices()
    {
        return auth()->user()->userServices()->count();
    }

    public function averageUserRating()
    {
    	$services = auth()->user()->userServices()->get();
    	if (!is_null($services)) {
    		$userRate = 0;

    		foreach ($services as $service) {
    			$userRate += $this->getAverageReview($service->ratings()->get());
    		}

    		return $userRate;
    	} else {
    		return 0;
    	}
    }

    private function getAverageReview($ratings)
    {
        $number_of_reviews = count($ratings);
        $total = 0;

        if ($number_of_reviews > 0) {
        	foreach ($ratings as $rating) {
	            $total += $rating->stars;
	        }
	        
            $average = $total / $number_of_reviews;
        } else {
            $average = 0;
        }

        return $average;
    }
}
