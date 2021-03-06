<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\Advert;
use SavyCon\Http\Requests\StoreAdvert;

class AdvertController extends Controller
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
        $adverts = Advert::latest()->paginate(20);

        return response($adverts, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdvert $request)
    {
        $validated = $request->validated();

        $advert = new Advert();

        if (!is_null($request->states)) {
            foreach ($request->states as $state => $id) {
                $advert->states .= $id.',';
            }
        }

        if ($request->image) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];

            \Image::make($request->image)->fit(1200, 809)->save('images/adverts/'.$name);
            
            $request->merge(['image' => $name]);
        }

        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->URL = $request->URL;
        $advert->layer = $request->layer;
        $advert->package = $request->package;
        $advert->image = $request->image;
        $advert->save();
        
        return response($advert, 200);
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
        $advert = Advert::findOrFail($id);

        $this->deleteAdvertImage($advert);

        $advert->delete();

        return response([
            'message' => 'Delete Complete!'
        ], 200);
    }

    public function deleteAdvertImage(Advert $advert)
    {
        $image = 'images/adverts/'.$advert->image;
        if (file_exists($image)) {
            @unlink($image);
        }
    }
}
