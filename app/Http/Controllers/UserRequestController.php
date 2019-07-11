<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function userRequests()
    {
        $userRequests = auth('api')->user()->city->userRequests()->with([
        	'user',
        	'service',
        	'service.category'
        ])->latest()->paginate(10);

        return response($userRequests, 200);
    }
}
