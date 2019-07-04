<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\User;
use SavyCon\Http\Requests\StoreUserData;

class ProfileController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
        $user = User::with([
            'city',
            'city.state'
        ])->where('id', auth()->user()->id)
        ->get()[0];

    	return response($user, 200);
    }

    public function update(StoreUserData $request)
    {
    	$validated = $request->validated();

    	$user = auth()->user();
    	$user->update([
    		$request->all()
    	]);

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
