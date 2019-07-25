<?php

namespace SavyCon\Http\Controllers\User;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\UserRequest;
use SavyCon\Http\Requests\StoreUserRequest;

class UserRequestController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('isUser');

        $userRequests = auth('api')->user()->userRequests()->with([
            'service',
            'service.category'
        ])->latest()->paginate(10);

        return response($userRequests, 200);
    }

    public function store(StoreUserRequest $request)
    {
        $this->authorize('isUser');

    	$validated = $request->validated();

    	$userRequest = new UserRequest();
    	$userRequest->user_id = auth('api')->user()->id;
    	$userRequest->service_id = $request->input('service.id');
    	$userRequest->title = $request->title;
    	$userRequest->description = $request->description;
    	$userRequest->price = $request->price;
        $userRequest->address = $request->address;
    	$userRequest->save();

    	return response($userRequest, 200);
    }

    public function show($id)
    {
        $this->authorize('isUser');

        $userRequest = UserRequest::findOrFail($id)->with([
            'service',
            'service.category'
        ])->first();

        return response($userRequest, 200);
    }

    public function update(StoreUserRequest $request, $id)
    {
        $this->authorize('isUser');

        $validated = $request->validated();

        $userRequest = UserRequest::findOrFail($id);
        $userRequest->service_id = $request->input('service.id');
        $userRequest->title = $request->title;
        $userRequest->description = $request->description;
        $userRequest->price = $request->price;
        $userRequest->address = $request->address;
        $userRequest->save();

        return response($userRequest, 200);
    }

    public function delete($id)
    {
        $this->authorize('isUser');

        $userRequest = UserRequest::findOrFail($id);
        $userRequest->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
