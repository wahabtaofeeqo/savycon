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

    public function services($id)
    {
    	$category = Category::findOrFail($id);

    	return response($category->services, 200);
    }
}
