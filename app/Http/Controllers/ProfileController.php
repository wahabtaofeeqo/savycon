<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\User;
use SavyCon\Http\Requests\StoreUserData;
use SavyCon\Http\Requests\UpdateUserData;

class ProfileController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function index()
    {
        $user = User::with([
            'city',
            'city.state'
        ])->where('id', auth('api')->user()->id)
        ->get()[0];

    	return response($user, 200);
    }

    public function show(Request $request, $id)
    {
        // 
    }

    public function store(Request $request)
    {
        // 
    }

    public function update(UpdateUserData $request, $id)
    {
    	$validated = $request->validated();

        $user = auth()->user();

        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

    	$user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->city_id = $request->city_id;
        $user->code = $request->code;
        $user->save();

    	return response($user, 200);
    }

    public function delete()
    {
    	$user = auth()->user()->delete();

    	// Close all sessions and logout

    	return response([
    		'message' => 'Delete Complete!'
    	], 200);
    }
}
