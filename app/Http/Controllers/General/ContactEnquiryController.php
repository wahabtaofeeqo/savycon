<?php

namespace SavyCon\Http\Controllers\General;

use SavyCon\Models\ContactEnquiry;
use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreNewContactEnquiry;

class ContactEnquiryController extends Controller
{
    public function store(StoreNewContactEnquiry $request)
    {
        $validated = $request->validated();

        $enquiry = new ContactEnquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->route('contact')->with('status', 'Message was submitted successfully');
    }
}
