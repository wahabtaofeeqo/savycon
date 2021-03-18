<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

class DonateController extends Controller {
    
    public function index() {
        return view('pages.donate');
    }

    public function donate(Request $request) {
    	$response = array('error' => FALSE, 'message' => '');
    	return response($response, 200);
    }

    public function addDonator(Request $request) {
    	$response = array('error' => FALSE, 'message' => '');
    	return response($response, 200);
    }
}