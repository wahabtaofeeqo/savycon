<?php

namespace SavyCon\Http\Controllers;

use Illuminate\Http\Request;
use SavyCon\Models\UsersNeed;
use Auth;
use SavyCon\Models\Visitor;

class UsersNeedController extends Controller {
    
    public function __construct() {
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

       $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

       $data = array();

       foreach ($months as $key => $month) {
           $row = new \stdClass();
           $row->month = $month;
           $row->total = 0;
           $data[] = $row;
       }

       $stats = Visitor::all()->groupBy('month');

       foreach ($stats as $key => $stat) {

           foreach ($data as $da) {
               if ($da->month == $key) {
                   $da->total = count($stat);
               }
           }
       }

       return response($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
       
       $request->validate([
            'need' => 'required'
        ]);

       $response = array('error' => FALSE, 'message' => '');

       $un = new UsersNeed();
       $un->content = $request->need;
       $un->save();

       $response['message'] = 'Sent Successfully';
       
       return response($response, 200);
    }

    public function visitor(Request $request) {

    	$response = array('show' => FALSE, 'message' => '');

        $ip = $request->ip;
        $count = Visitor::where('ip', $ip)->count();

        if ($count) {
                
            //This Month
            $check = Visitor::where(['ip' => $ip, 'month' => date('F')])->first();
                
            if ($check) {
                $check->total = $check->total + 1;
                $check->save();
            }
            else {
                    
                $visitor = new Visitor();
                $visitor->ip = $ip;
                $visitor->month = date('F');
                $visitor->save();
            }
        }
        else {
                
            $visitor = new Visitor();
            $visitor->ip = $ip;
            $visitor->month = date('F');
            $visitor->save();
        }

        $response['show'] = ($count > 10) ? FALSE : TRUE;

    	return response($response, 200);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }
}
