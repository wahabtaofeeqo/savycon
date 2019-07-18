<?php

namespace SavyCon\Http\Controllers\General;

use SavyCon\Models\Subscription;
use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Http\Requests\StoreNewSubscription;

class SubscriptionController extends Controller
{
    public function store(StoreNewSubscription $request)
    {
        $validated = $request->validated();

        $subscription = new Subscription();
        $subscription->email = $request->email;
        $subscription->save();

        return redirect($request->page)->with('status', 'Thank you for subscribing');
    }
}
