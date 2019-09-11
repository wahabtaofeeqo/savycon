<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\UpdateUserData;
use SavyCon\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserData $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if ($request->password) {
            $user->password = \Hash::make($request->password);
        }

        $user->save();

        return response($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }

    /**
     * Load all the vendors
    */
    public function vendors()
    {
        $vendors = User::withCount([
            'userServices'
        ])
        ->with([
            'city',
            'city.state'
        ])->where('role', 'vendor')->paginate(10);

        return response($vendors, 200);
    }

    /**
     * Load all the users
    */
    public function users()
    {
        $users = User::with([
            'city',
            'city.state'
        ])->where('role', 'user')->paginate(10);

        return response($users, 200);
    }

    public function alterSuspension($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->active == 0) {
            $user->active = 1;
        } else {
            $user->active = 0;
        }

        $user->save();

        return response([
            'message' => 'Success'
        ], 200);
    }
}
