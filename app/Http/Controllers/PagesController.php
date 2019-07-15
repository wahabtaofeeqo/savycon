<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\UserService;
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
        $service = UserService::with([
            'user',
            'service',
            'service.category'
        ])->findOrFail($id);

        return view('pages.services.single')->with([
            'service' => $service
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
