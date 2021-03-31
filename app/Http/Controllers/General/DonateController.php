<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;
use SavyCon\Models\Payment;
use SavyCon\Models\User;

class DonateController extends Controller {
    
    public function index() {
        return view('pages.donate');
    }

    public function donate(Request $request) {
    	$response = array('error' => FALSE, 'message' => '');
    	return response($response, 200);
    }

    public function donated() {
        return view('pages.thanks');
    }

    public function addDonator(Request $request) {
    	$response = array('error' => FALSE, 'message' => '');

        $request->validate(
            [
                'transaction' => 'required',
                'ref' => 'required',
                'amount' => 'required',
            ]);

        $user = User::find($request->user);

        $payment = new Payment();
        $payment->user_id = ($user) ? $user->id : 0;
        $payment->transaction_id = $request->transaction;
        $payment->reference = $request->ref;
        $payment->type = $request->type;
        $payment->user_service_id = 0;
        $payment->package = "";
        $payment->amount = $request->amount;

        $payment->save();

    	return response($response, 200);
    }
}