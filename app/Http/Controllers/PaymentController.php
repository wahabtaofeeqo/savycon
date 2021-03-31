<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;
use SavyCon\Models\Payment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        $this->middleware('auth:api');
    }

    public function index($userid = null) {

        $payments = array();
        if ($userid == null) {
            $payments = Payment::with([
                'user',
                'userService'
            ])->paginate();
        }
        else {
            $payments = Payment::with([
                'user',
                'userService'
            ])->where('user_id', $userid)->paginate();
        }
        
        return response($payments, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function servicePayment(Request $request) {

        $response = array('error' => FALSE, 'message' => '');

        $request->validate(
            [
                'transaction' => 'required',
                'ref' => 'required',
                'amount' => 'required',
                'service' => 'required',
            ]);

        $user = auth()->user();

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->transaction_id = $request->transaction;
        $payment->reference = $request->ref;
        $payment->type = $request->type;
        $payment->user_service_id = 0;
        $payment->package = "";
        $payment->description = $request->description;
        $payment->amount = $request->amount;

        $payment->save();

        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return response([
            'message' => 'Delete Complete'
        ], 200);
    }
}