<?php

namespace SavyCon\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\Category;
use SavyCon\Models\Service;


class CategoryController extends Controller
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
        $categories = Category::orderBy('name', 'ASC')->paginate(20);

        return response($categories, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required']);

        $category = new Category();
        $category->name = $request->name;

        if (!empty($request->image_tag)) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_tag, 0, strpos($request->image_tag, ';')))[1])[1];

            \Image::make($request->image_tag)->save('images/tags/'.$name);

            $category->image_tag = $name;
        }

        $category->save();
        return response($category, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    public function merge(Request $request) {
        $response = array('error' => FALSE, 'message' => 'Merged Successfully');

        $request->validate([
            'categories' => 'required',
            'parent' => 'required']);

        $categories = $request->categories;
        $parent = $request->parent;

        $check = Category::firstOrCreate(['name' => $parent]);

        $categories = explode(",", $categories);
        foreach ($categories as $key => $id) {

            //Get the Services by Category ID
            $services = Service::where('category_id', $id)->get();
            foreach ($services as $key => $service) {
                $service->category_id = $check->id;
                $service->save();
            }

            $category = Category::find($id);
            if ($category->id != $check->id) {
                $category->delete();
            }
        }

        return response($response, 200);
    }

    public function mergeSubcategories(Request $request) {

        $response = array('error' => FALSE, 'message' => 'Merged Successfully');

        $request->validate([
            'services' => 'required',
            'parent' => 'required',
            'category' => 'required']);

        $parent = $request->parent;
        $services = $request->services;
        $category = $request->category;
        
        $services = explode(",", $services);
        $category = Category::where('name', $category)->first();

        if ($category) {

            $check = Service::firstOrCreate(['name' => $parent], ['category_id' => $category->id]);
            foreach ($services as $key => $id) {
                //Get the Services by ID
                $service = Service::findOrFail($id);
                if ($service->id != $check->id) {
                    $service->delete();
                }
            }
        }
        else {
            $response['message'] = "Category specified not found";
        }

        return response($response, 200);
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
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if (!empty($request->image_tag)) {
            $name = str_replace(' ', '', str_replace('.', '', microtime())).'.'.explode('/', explode(':', substr($request->image_tag, 0, strpos($request->image_tag, ';')))[1])[1];

            \Image::make($request->image_tag)->save('images/tags/'.$name);

            $category->image_tag = $name;
        }
        $category->save();

        return response($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
