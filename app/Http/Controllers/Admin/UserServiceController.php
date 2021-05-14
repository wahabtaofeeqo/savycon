<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;
use Excel;
use FastExcel;
use Illuminate\Support\Facades\Hash;
use SavyCon\Models\UserService;
use SavyCon\Models\User;
use SavyCon\Models\Category;
use SavyCon\Models\City;
use SavyCon\Models\State;
use SavyCon\Models\Payment;
use SavyCon\Models\Service;
use SavyCon\Imports\UserServicesImport;

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
    public function index($state = null)
    {

        $services = array();
        if ($state != null) {

            $stateDetails = State::where('name', $state)->first();
            if ($stateDetails) {
                $city = City::where('state_id', $stateDetails->id)->first();
            }

            if ($city) {
                $services = UserService::with([
                    'user',
                    'service',
                    'service.category',
                    'city',
                    'city.state'
                ])->where('active', 1)->where('city_id', $city->id)->orWhere('title', 'like', '%'. $state . '%')->latest()->paginate(30);
            }
        }
        else {
            $services = UserService::with([
                'user',
                'service',
                'service.category',
                'city',
                'city.state'
            ])->where('active', 1)->latest()->paginate(30);
        }

        return response($services, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       
       $response = array('error' => FALSE, 'message' => '');

       $request->validate([
            'file' => 'required|file|mimes:xls,xlsx'
        ]);

       if ($request->hasFile('file')) {

            $path = $request->file('file');
            $data = Excel::import(new UserServicesImport(1), $request->file('file'));
            
            $response['error'] = FALSE;
            $response['message'] = 'Successfully uploaded';
       }
       else {
        $response['error'] = TRUE;
        $response['message'] = 'No File uploaded';
       }
       
       return response($response, 200);
    }

    public function activateService($id) {
        
        $response = array('error' => FALSE, 'message' => 'Updated Successfully');

        $service = UserService::find($id);
        $service->active = 1;
        $service->save();

        return response($response, 200);
    }

    /**
     * Display non activated services.
     *
     * @param  int  $active
     * @return \Illuminate\Http\Response
     */

    public function show($active = 0) {
        $services = UserService::with([
            'user',
            'service',
            'service.category',
            'city',
            'city.state'
        ])->where('active', 0)->latest()->paginate(30);

        return response($services, 200);
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

    public function feature(Request $request) {

        $request->validate(
            [
                'id' => 'required',
                'transaction' => 'required',
                'ref' => 'required',
                'amount' => 'required',
                'package' => 'required'
            ]);

        $user = auth()->user();
        $service = UserService::findOrFail($request->id);

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->transaction_id = $request->transaction;
        $payment->reference = $request->ref;
        $payment->type = $request->type;
        $payment->user_service_id = $service->id;
        $payment->package = $request->package;
        $payment->amount = $request->amount;

        $payment->save();

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