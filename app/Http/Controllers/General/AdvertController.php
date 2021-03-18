<?php

namespace SavyCon\Http\Controllers\General;

use Illuminate\Http\Request;
use SavyCon\Http\Controllers\Controller;

use SavyCon\Models\Advert;

class AdvertController extends Controller
{
    public function dashboard($limit)
    {
    	//$adverts = Advert::inRandomOrder()->where('layer', 'all')->orWhere('layer', 'dashboard')->limit($limit)->get();
    	$adverts = Advert::inRandomOrder()->where('layer', 'dashboard')->where('active', 1)->limit($limit)->get();
    	return response($adverts, 200);
    }

    public function activate($id) {
    	
    	$ad = Advert::findOrFail($id);
    	$ad->active = 1;
    	$ad->save();

    	return response(array('message' => 'Advert has been activated Successfully'), 200);
    }

    public function delete() {
        $response = array('status' => FALSE, 'message' => 'Deleted Successfully');

        $advertsToDelete = Advert::whereDate('created_at', '<', date("Y-m-d"))->get();
        foreach ($advertsToDelete as $key => $advert) {
            $this->deleteAd($advert);
        }

        return response($response, 200);
    }

    private function deleteAd($advert) {

        $today = date_create(date('Y-m-d'));
        $created = date_create(date('Y-m-d', strtotime($advert->created_at)));

        $days = intval(date_diff($created, $today, TRUE)->format('%a'));

        if ($advert->package == 'month' && $days >= 30) {
            $advert->delete();
        }
        elseif ($advert->package == 'week' && $days >= 7) {
            $advert->delete();
        }
    }
}