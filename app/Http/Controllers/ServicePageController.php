<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;

use SavyCon\Models\ServicePage;

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
            'content' => 'required',
            'phonenumber' => 'required',
            'whatsapp' => 'required',
            'description' => 'required',
        ]);

        ServicePage::create([
            'category' => $request->category,
            'content' => $request->content,
            'description' => $request->description,
            'phonenumber' => $request->phonenumber,
            'whatsapp' => $request->whatsapp,
        ]);

        return response(array('status' => 'success', 'message' => 'Inserted'));
    }

}
