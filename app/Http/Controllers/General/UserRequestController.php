<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\UserRequest;

class UserRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function userRequests()
    {
        if (auth()->user()->role == 'vendor') {
            $userRequests = auth('api')->user()->city->userRequests()->with([
                'user',
                'service',
                'service.category'
            ])->latest()->paginate(10);
        } else {
            $userRequests = UserRequest::with([
                'user',
                'service',
                'service.category'
            ])->latest()->paginate(10);
        } 

        return response($userRequests, 200);
    }
}
