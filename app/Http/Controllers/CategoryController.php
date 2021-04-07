<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\Category;
use SavyCon\Models\Service;

class CategoryController extends Controller
{
    public function index()
    {
    	$category = Category::orderBy('name', 'ASC')->get();
    	
    	return response($category, 200);
    }

    public function limitedIndex()
    {
        $category = Category::withCount([
            'userServices'
        ])->orderBy('user_services_count', 'DESC')
        ->orderBy('name', 'ASC')
        ->limit(5)
        ->get();
        
        return response($category, 200);
    }

    public function services($id)
    {
    	$category = Category::findOrFail($id);
    	return response($category->services, 200);
    }

    public function servicesFromCategory($name) {
        $category = Category::where('name', $name)->first();
        return response($category->services, 200);
    }

    public function showUserServices($id) 
    {
        $services = Category::findOrFail($id)->userServices()->with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
        ])->latest()->paginate(20);

        return response($services, 200);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response($category, 200);
    }

    // Sub-category
    public function showUserServicesFromSub($id) 
    {
        $services = Service::findOrFail($id)->userServices()->with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
        ])->latest()->paginate(20);

        return response($services, 200);
    }

    // Services
    public function subCategories() {
        $services = Service::latest()->paginate(20);
        return response($services, 200);
    }

    public function showSub($id)
    {
        $sub_category = Service::with([
            'category'
        ])->findOrFail($id);

        return response($sub_category, 200);
    }

    public function categories($name) {
        return Category::whereLike('name', $name)->limit(10)->get();
    }
}