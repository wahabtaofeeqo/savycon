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
    	return number_format(State::count());
    }

    public function totalCities()
    {
    	return number_format(City::count());
    }

    public function totalCategories()
    {
    	return number_format(Category::count());
    }

    public function totalSubCategories()
    {
    	return number_format(Service::count());
    }

    public function totalServices()
    {
    	return number_format(UserService::count());
    }

    public function featuredServices()
    {
    	return number_format(UserService::where('featured', 1)->count());
    }

    public function bannedServices()
    {
    	return number_format(UserService::where('active', 0)->count());
    }

    public function totalVendors()
    {
    	return number_format(User::where('role', 'vendor')->count());
    }

    public function suspendedVendors()
    {
    	return number_format(User::where([
    		['role', 'vendor'],
    		['active', 0]
    	])->count());
    }

    public function totalBuyers()
    {
    	return number_format(User::where('role', 'user')->count());
    }

    public function totalSubscribers()
    {
    	return number_format(Subscription::count());
    }

    public function totalContactMessages()
    {
    	return number_format(ContactEnquiry::count());
    }

    public function totalVendorMessages()
    {
    	return number_format(UserServiceMessage::count());
    }

    public function totalUnfoundSearches()
    {
    	return number_format(Search::count());
    }

    public function totalBuyerRequests()
    {
    	return number_format(UserRequest::count());
    }

    public function totalVendorServices()
    {
        return number_format(auth()->user()->userServices()->count());
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
