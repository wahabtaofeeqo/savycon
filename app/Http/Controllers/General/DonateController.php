<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

class DonateController extends Controller {
    
    public function index() {
        return view('pages.donate');
    }
}