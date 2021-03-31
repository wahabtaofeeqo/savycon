<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\ServicePage;
use SavyCon\Models\ServiceLink;

class ServicePageController extends Controller
{
    public function index()
    {
    	$servicepages = ServicePage::latest()->paginate(10);

    	return response($servicepages, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'category' => 'required',
            'subcategory' => 'required',
            'content' => 'required',
            'phonenumber' => 'required',
            'whatsapp' => 'required',
            'description' => 'required',
        ]);

        ServicePage::create([
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'content' => $request->content,
            'description' => $request->description,
            'phonenumber' => $request->phonenumber,
            'whatsapp' => $request->whatsapp,
        ]);

        return response(array('status' => 'success', 'message' => 'Inserted'));
    }

    public function deleteService($id) {
        $response = array('error' => FALSE, 'message' => 'Deleted: ' . $id);

        $servicepage = ServicePage::find($id);
        if ($servicepage) {
            $servicepage->delete();
        }

        return response($response, 200);
    }

    public function serviceLink(Request $request) {

        $request->validate([
            'service' => 'required',
            'price' => 'required',
            'description' => 'required',
            'currency' => 'required',
        ]);

        $uid = uniqid();

        ServiceLink::create([
            'service' => $request->service,
            'price' => $request->price,
            'uid' => $uid,
            'currency' => $request->currency,
            'description' => $request->description]);

        $service = urlencode(strtolower($request->service));

        $link = url("service-details?service=$service&id=$uid");
        $response = array('error' => FALSE, 'message' => '', 'link' => $link);

        return response($response, 200);
    }
}