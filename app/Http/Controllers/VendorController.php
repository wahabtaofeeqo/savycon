<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

class VendorController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
    	return view('user.home');
    }
}
