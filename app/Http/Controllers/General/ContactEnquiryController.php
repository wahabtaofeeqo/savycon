<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\ContactEnquiry;
use SavyCon\Http\Requests\StoreNewContactEnquiry;

class ContactEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth:api');

        $contacts = ContactEnquiry::latest()->paginate(10);

        return response($contacts, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewContactEnquiry $request)
    {
        $validated = $request->validated();

        $enquiry = new ContactEnquiry();
        $enquiry->name = $request->name;
        $enquiry->email = $request->email;
        $enquiry->phone = $request->phone;
        $enquiry->message = $request->message;
        $enquiry->save();

        return redirect()->route('contact')->with('status', 'Message was submitted successfully');
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
        $contact = ContactEnquiry::findOrFail($id);
        $contact->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}
