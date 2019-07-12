<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\Category;

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

    public function showUserServices($id) 
    {
        $services = Category::findOrFail($id)->userServices()->with([
            'user',
            'service',
            'service.category'
        ])->latest()->paginate(20);

        return response($services, 200);
    }
}
