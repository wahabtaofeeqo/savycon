<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\State;

use SavyCon\Http\Requests\StoreStateData;

class StateController extends Controller
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
        $states = State::withCount([
            'cities', 
        ])->paginate(20);

        return response($states, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateData $request)
    {
        $validated = $request->validated();

        $state = new State();
        $state->name = $request->name;
        $state->save();

        return response($state, 200);
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
    public function update(StoreStateData $request, $id)
    {
        $validated = $request->validated();

        $state = State::findOrFail($id);
        $state->name = $request->name;
        $state->save();

        return response($state, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state = State::findOrFail($id);
        $state->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
