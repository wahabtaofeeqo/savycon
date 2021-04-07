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
    public function index($type = "") {

       $data = array();

       $times =  ['12-3am', '3-6am', '6-9am', '9-12pm', '12-3pm', '3-6pm', '6-9pm', '9-11pm'];
       $times1 =  ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
       $weekDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
       $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

       switch ($type) {

         case 'daily':
           $groupBy = "time";
           foreach ($times1 as $key => $time) {
               $row = new \stdClass();
               $row->time = $time;
               $row->total = 0;
               $data[] = $row;
           }
           break;

         case 'weekly':
           $groupBy = "day";
           foreach ($weekDays as $key => $day) {
               $row = new \stdClass();
               $row->day = $day;
               $row->total = 0;
               $data[] = $row;
           }
           break;

         default:
           $groupBy = "month";
           foreach ($months as $key => $month) {
               $row = new \stdClass();
               $row->month = $month;
               $row->total = 0;
               $data[] = $row;
           }

           break;
       }

       $stats = Visitor::all()->groupBy($groupBy);
       $data  = $this->prepareData($data, $stats, $type);
  
       return response($data, 200);
    }

    private function prepareData($data, $stats, $type) {
      if ($type == 'weekly') {
          foreach ($stats as $key => $stat) {
             foreach ($data as $da) {
                 if ($da->day == $key) {
                    $da->total = count($stat);
                 }
             }
         }
      }
      elseif ($type == 'daily') {
          foreach ($stats as $key => $stat) {
             foreach ($data as $da) {
                 if ($da->time == $key) {
                    $da->total = count($stat);
                 }
             }
         }
      }
      else {
        foreach ($stats as $key => $stat) {
           foreach ($data as $da) {
               if ($da->month == $key) {
                  $da->total = count($stat);
               }
           }
       }
      }

      return $data;
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

       session(['needSession' => TRUE]);
       $response['message'] = 'Sent Successfully';
       $response['session'] = session('needSession', false);
       
       return response($response, 200);
    }

    public function visitor(Request $request) {

    	  $response = array('show' => FALSE, 'message' => '');
        $ip = $request->ip;
        $today = date('Y-m-d');

        $hasVisitedToday = Visitor::where('ip', $ip)->whereDate('created_at', $today)->first();
        $count = Visitor::where('ip', $ip)->count(); // To determine how often the user visits

        if (!$hasVisitedToday) {

          $visitor = new Visitor();
          $visitor->ip = $ip;
          $visitor->month = date('F');
          $visitor->day = date('l');
          $visitor->total = 0;
          $visitor->time = $this->timeRange();
          $visitor->save();
        }
        else {
          $hasVisitedToday->total = $hasVisitedToday->total + 1;
          $hasVisitedToday->save();
        }

        $response['show'] = ($count > 10) ? FALSE : TRUE;
    	  return response($response, 200);
    }

    private function timeRange() {

      $amOrPm = date('a');
      $hour = date('h');
      $ranges = [];

      return $hour;
    }

    public function needSession(Request $request) {

      $response = array('show' => FALSE, 'message' => '');
      $response['asked'] = session('needSession');

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
