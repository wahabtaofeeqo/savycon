<?php

namespace SavyCon\Http\Controllers\General;

use SavyCon\Models\Subscription;
use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreNewSubscription;

class SubscriptionController extends Controller {

    public function index() {
        $list = Subscription::latest()->paginate(30);

        return response($list, 200);
    }

    public function store(StoreNewSubscription $request)
    {
        $validated = $request->validated();

        $subscription = new Subscription();
        $subscription->email = $request->email;
        $subscription->save();

        return redirect($request->page)->with('status', 'Thank you for subscribing');
    }


    public function subscribe(Request $request) {

        $request->validate([
            'email' => 'required|email'
        ]);
        
        $subscription = Subscription::firstOrCreate(['email' => $request->email]);

        $response = array('message' => 'Thank you for subscribing');
        return response($response, 200);
    }

    public function edit(Request $request) {

        $response = array('error' => FALSE, 'message' => '');
        $request->validate([
            'email' => 'required|email',
        ]);

        $sub = Subscription::find($request->id);
        if ($sub) {
            $sub->email = $request->email;
            $sub->save();
        }

        return response($response, 200);
    }

    public function destroy($id) {
        $response = array('error' => FALSE, 'message' => '');
        $user = Subscription::find($id);
        $user->delete();
        
        return response($response, 200);
    }
}
