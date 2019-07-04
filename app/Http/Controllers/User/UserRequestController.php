<?php

namespace SavyCon\Http\Controllers\User;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

class UserRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function store(StoreUserRequest $request)
    {
    	$validated = $request->validated();

    	$userRequest = new UserRequest();
    	$userRequest->user_id = auth()->user()->id;
    	$userRequest->service_id = $request->input('service.id');
    	$userRequest->title = $request->title;
    	$userRequest->description = $request->description;
    	$userRequest->price = $request->price;
    	$userRequest->save();

    	return respoonse($userRequest, 200);
    }
}
