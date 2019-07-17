<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;
use SavyCon\Models\User;
use SavyCon\Models\Category;
use SavyCon\Models\Service;

class PagesController extends Controller
{
    public function index()
    {
    	return view('pages.index');
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
            if (!empty($ratings)) {
                $alreadyReviewed = 1;
            }
        }
        // return $alreadyReviewed;

        return view('pages.services.single')->with([
            'service' => $service,
            'canComment' => $canComment,
            'alreadyReviewed' => $alreadyReviewed
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
}
