<?php

namespace SavyCon\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreVendorService;
use SavyCon\Models\UserService;

class ServiceController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$services = auth()->user()->userServices()->with([
            'service',
            'service.category'
        ])->paginate(10);

        return response($services, 200);
    }

    public function store(StoreVendorService $request)
    {
    	$validated = $request->validated();

        if ($request->image_1) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_1, 0, strpos($request->image_1, ';')))[1])[1];

            \Image::make($request->image_1)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_1' => $name]);
        }
        if ($request->image_2) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_2, 0, strpos($request->image_2, ';')))[1])[1];

            \Image::make($request->image_2)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_2' => $name]);
        }
        if ($request->image_3) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_3, 0, strpos($request->image_3, ';')))[1])[1];

            \Image::make($request->image_3)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_3' => $name]);
        }

        $service = new UserService();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image_1 = $request->image_1;
        $service->image_2 = $request->image_2;
        $service->image_3 = $request->image_3;
        $service->user_id = auth()->user()->id;
        $service->service_id = $request->input('service.id');
        $service->save();

        return response($service, 200);
    }

    public function show($id) 
    {
        $service = UserService::with([
            'service',
            'service.category'
        ])
        ->findOrFail($id);

        return response($service, 200);
    }

    public function update(UpdateVendorService $request, $id)
    {
    	$validated = $request->validated();

        $service = UserService::findOrFail($id);

        if ($request->image_1 && (strlen($request->image_1) > 50)) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_1, 0, strpos($request->image_1, ';')))[1])[1];

            \Image::make($request->image_1)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_1' => $name]);
            $service->image_1 = $request->image_1;
        }
        if ($request->image_2 && (strlen($request->image_2) > 50)) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_2, 0, strpos($request->image_2, ';')))[1])[1];

            \Image::make($request->image_2)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_2' => $name]);
            $service->image_2 = $request->image_2;
        }
        if ($request->image_3 && (strlen($request->image_3) > 50)) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_3, 0, strpos($request->image_3, ';')))[1])[1];

            \Image::make($request->image_3)->fit(1200, 1480)->save('images/services/'.$name);
            
            $request->merge(['image_3' => $name]);
            $service->image_3 = $request->image_3;
        }

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->user_id = auth()->user()->id;
        $service->service_id = $request->input('service.id');
        $service->save();

        return response($service, 200);
    }

    public function delete($id)
    {
        $service = UserService::findOrFail($id);
        $service->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
