<?php

namespace SavyCon\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreVendorService;
use SavyCon\Http\Requests\UpdateVendorService;

use SavyCon\Models\UserService;

class ServiceController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth:api');
    }

    public function index()
    {
        $this->authorize('isActiveVendorOrAdmin');

    	$services = auth()->user()->userServices()->with([
            'service',
            'service.category',
            'ratings',
            'city',
            'city.state'
        ])->latest()->paginate(10);

        return response($services, 200);
    }

    public function store(StoreVendorService $request)
    {
        $this->authorize('isActiveVendorOrAdmin');

    	$validated = $request->validated();

        if ($request->image_1) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_1, 0, strpos($request->image_1, ';')))[1])[1];

            \Image::make($request->image_1)->save('images/services/'.$name);
            
            $request->merge(['image_1' => $name]);
        }
        if ($request->image_2) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_2, 0, strpos($request->image_2, ';')))[1])[1];

            \Image::make($request->image_2)->save('images/services/'.$name);
            
            $request->merge(['image_2' => $name]);
        }
        if ($request->image_3) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_3, 0, strpos($request->image_3, ';')))[1])[1];

            \Image::make($request->image_3)->save('images/services/'.$name);
            
            $request->merge(['image_3' => $name]);
        }

        $service = new UserService();
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->image_1 = $request->image_1;
        $service->image_2 = $request->image_2;
        $service->image_3 = $request->image_3;
        $service->address = $request->address;
        $service->landmark = $request->landmark;
        $service->user_id = auth('api')->user()->id;
        $service->city_id = $request->input('city.id');
        $service->service_id = $request->input('service.id');
        $service->save();

        return response($service, 200);
    }

    public function show($id) 
    {
        $service = UserService::with([
            'service',
            'service.category',
            'city',
            'city.state'
        ])
        ->findOrFail($id);

        return response($service, 200);
    }

    public function update(UpdateVendorService $request, $id)
    {
        $this->authorize('isActiveVendorOrAdmin');

    	$validated = $request->validated();

        $service = UserService::findOrFail($id);

        if ($request->image_1 && (strlen($request->image_1) > 50)) {
            $serviceImage = 'images/services/'.$service->image_1;
            if (file_exists($serviceImage)) {
                @unlink($serviceImage);
            }

            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_1, 0, strpos($request->image_1, ';')))[1])[1];

            \Image::make($request->image_1)->save('images/services/'.$name);
            
            $request->merge(['image_1' => $name]);
            $service->image_1 = $request->image_1;
        }
        if ($request->image_2 && (strlen($request->image_2) > 50)) {
            $serviceImage = 'images/services/'.$service->image_2;
            if (file_exists($serviceImage)) {
                @unlink($serviceImage);
            }

            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_2, 0, strpos($request->image_2, ';')))[1])[1];

            \Image::make($request->image_2)->save('images/services/'.$name);
            
            $request->merge(['image_2' => $name]);

            $service->image_2 = $request->image_2;
        }
        if ($request->image_3 && (strlen($request->image_3) > 50)) {
            $serviceImage = 'images/services/'.$service->image_3;
            if (file_exists($serviceImage)) {
                @unlink($serviceImage);
            }

            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_3, 0, strpos($request->image_3, ';')))[1])[1];

            \Image::make($request->image_3)->save('images/services/'.$name);
            
            $request->merge(['image_3' => $name]);
            $service->image_3 = $request->image_3;
        }

        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->address = $request->address;
        $service->landmark = $request->landmark;
        $service->city_id = $request->input('city.id');
        $service->service_id = $request->input('service.id');
        $service->save();

        return response($service, 200);
    }

    public function delete($id)
    {
        $this->authorize('isActiveVendorOrAdmin');
        
        $service = UserService::findOrFail($id);

        $this->deleteServiceImages($service);

        $service->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }

    public function deleteServiceImages(UserService $service)
    {
        $serviceImage = 'images/services/'.$service->image_1;
        if (file_exists($serviceImage)) {
            @unlink($serviceImage);
        }
        $serviceImage = 'images/services/'.$service->image_2;
        if (file_exists($serviceImage)) {
            @unlink($serviceImage);
        }
        $serviceImage = 'images/services/'.$service->image_3;
        if (file_exists($serviceImage)) {
            @unlink($serviceImage);
        }
    }
}
