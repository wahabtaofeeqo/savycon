<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;
use SavyCon\Models\UserService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {

        $count = UserService::where('active', 0)->count();
        return redirect()->route(auth()->user()->role)->with(['services' => $count]);
    }
}
