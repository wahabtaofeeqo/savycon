<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\UserService;

class UserServiceController extends Controller
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
        $services = UserService::with([
            'user',
            'service',
            'service.category'
        ])->orderBy('id', 'ASC')->paginate(15);

        return response($services, 200);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = UserService::findOrFail($id);
        $service->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }

    public function alterBan($id)
    {
        $service = UserService::findOrFail($id);

        if ($service->active == 0) {
            $service->active = 1;
        } else {
            $service->active = 0;
        }

        $service->save();

        return response([
            'message' => 'Success'
        ], 200);
    }

    public function alterFeature($id)
    {
        $service = UserService::findOrFail($id);

        if ($service->featured == 0) {
            $service->featured = 1;
        } else {
            $service->featured = 0;
        }

        $service->save();

        return response([
            'message' => 'Success'
        ], 200);
    }
}
