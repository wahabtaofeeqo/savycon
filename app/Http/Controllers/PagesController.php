<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
    	return view('pages.index');
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

    public function help()
    {
    	return view('pages.help');
    }
}
