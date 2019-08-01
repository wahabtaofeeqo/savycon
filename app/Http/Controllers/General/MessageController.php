<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\UserServiceMessage;
use SavyCon\Http\Requests\StoreMessage;

class MessageController extends Controller
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
        $messages = UserServiceMessage::with([
            'userService',
            'userService.service',
            'userService.service.category',
        ])
        ->latest()->get();

        return response($messages, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMessage $request)
    {
        $validated = $request->validated();

        $message = new UserServiceMessage();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->message = $request->message;
        $message->user_service_id = $request->service_id;
        $message->save();

        return response($message, 200);
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
        $message = UserServiceMessage::findOrFail($id);
        $message->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }

    public function getVendorMessages()
    {
        $messages = [];

        $services = auth()->user()->userServices()->get();
        if (!is_null($services)) {
            foreach ($services as $service) {
                if (!is_null($service->messages()->get())) {
                    array_push($messages, $service->messages()->with([
                        'userService',
                        'userService.service',
                        'userService.service.category',
                    ])->latest()->get());
                }
            }
        }

        return response($messages, 200);
    }
}
