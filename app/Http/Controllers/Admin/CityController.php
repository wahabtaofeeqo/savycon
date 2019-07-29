<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\City;

use SavyCon\Http\Requests\StoreCityData;

class CityController extends Controller
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
        $cities = City::with([
            'state'
        ])
        ->orderBy('name', 'ASC')
        ->paginate(20);

        return response($cities, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityData $request)
    {
        $validated = $request->validated();

        $city = new City();
        $city->name = $request->name;
        $city->state_id = $request->input('state.id');
        $city->save();

        return response($city, 200);
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
    public function update(StoreCityData $request, $id)
    {
        $validated = $request->validated();

        $city = City::findOrFail($id);
        $city->name = $request->name;
        $city->state_id = $request->input('state.id');
        $city->save();

        return response($city, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
