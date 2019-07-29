<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;
use SavyCon\Models\User;
use SavyCon\Models\Category;
use SavyCon\Models\Service;
use SavyCon\Models\UserServiceRating;

class PagesController extends Controller
{
    public function index()
    {
        $featured_services = UserService::inRandomOrder()->where('featured', '1')->with([
            'user',
            'service',
            'service.category'
        ])->where('active', 1)->latest()->get();

    	return view('pages.index', [
            'featured_services' => $featured_services
        ]);
    }

    public function services()
    {
    	return view('pages.services');
    }

    public function showService($id)
    {
        $service = UserService::withCount('ratings')->
        with([
            'user',
            'service',
            'service.category'
        ])->findOrFail($id);

        $alreadyReviewed = null;
        $canComment = 1;

        if (auth()->user()) {
            if (auth()->user()->id === $service->id) {
                $canComment = null;
            }

            $ratings = auth()->user()->ratings()->where('user_service_id', $service->id)->get();
            if (count($ratings) > 0) {
                $alreadyReviewed = 1;
            }
        }

        $average_rating = $this->getAverageReview(UserServiceRating::where('user_service_id', $service->id)->get()); 

        return view('pages.services.single')->with([
            'service' => $service,
            'canComment' => $canComment,
            'alreadyReviewed' => $alreadyReviewed,
            'average_rating' => $average_rating
        ]);
    }

    public function userServices($id) 
    {
        $user = User::findOrFail($id);
        $services = UserService::where('user_id', $id)->paginate(1);

        return view('pages.services.user')->with([
            'user' => $user,
            'services' => $services
        ]);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
    	return view('pages.contact');
    }

    public function terms()
    {
    	return view('pages.terms');
    }

    public function privacyPolicy()
    {
    	return view('pages.privacyPolicy');
    }

    public function howItWorks()
    {
        return view('pages.howItWorks');
    }

    public function help()
    {
        return view('pages.help');
    }

    public function loadCategory($id)
    {
        $category = Category::findOrFail($id);

        return view('pages.services.category')->with([
            'category' => $category,
        ]);
    }

    public function loadSubCategory($id)
    {
        $subCategory = Service::findOrFail($id);

        return view('pages.services.subCategory')->with([
            'subCategory' => $subCategory,
        ]);
    }

    private function getAverageReview($ratings)
    {
        $number_of_reviews = count($ratings);
        $total = 0;

        foreach ($ratings as $rating) {
            $total += $rating->stars;
        }

        if ($number_of_reviews > 0) {
            $average = $total / $number_of_reviews;
        } else {
            $average = 0;
        }

        return $average;
    }
}
