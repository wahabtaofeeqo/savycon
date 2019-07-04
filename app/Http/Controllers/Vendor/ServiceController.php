<?php

namespace SavyCon\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreVendorService;

class ServiceController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$services = auth()->user()->userServices()->paginate(10);

        return response($services, 200);
    }

    public function store(StoreVendorService $request)
    {
    	$validated = $request->validated();


    }

    public function update(StoreVendorService $request)
    {
    	$validated = $request->validated();


    }

    public function delete($id)
    {

    }
}
