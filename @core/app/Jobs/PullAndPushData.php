<?php

namespace App\Jobs;

use DB;
use App\User;
use App\Country;
use App\Service;
use App\Category;
use App\ServiceCity;
use App\ServiceArea;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PullAndPushData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $country = Country::first();

        // States / ServiceCity
        $offset = ServiceCity::count(); 
        $states = DB::connection('mysql1')->select("SELECT * FROM states LIMIT 1000 OFFSET " . $offset);
        foreach ($states as $key => $state) {
            ServiceCity::create([
                'country_id' => $country->id,
                'service_city' => $state->name
            ]);
        }

        // Cities / ServiceArea
        $offset = ServiceArea::count(); 
        $cities = DB::connection('mysql1')->select("SELECT * FROM cities LIMIT 1000 OFFSET " . $offset);
        foreach ($cities as $key => $city) {
            ServiceArea::create([
                'country_id' => $country->id,
                'service_area' => $city->name,
                'service_city_id' => $city->state_id
            ]);
        }

        // Categories
        $offset = Category::count(); 
        $categories = DB::connection('mysql1')->select("SELECT * FROM categories LIMIT 1000 OFFSET " . $offset);
        foreach ($categories as $key => $model) {
            Category::create([
                'name' => $model->name
            ]);
        }

        // Users
        $offset = User::count(); 
        $users = DB::connection('mysql1')->select("SELECT * FROM users LIMIT 1000 OFFSET " . $offset);
        foreach ($users as $key => $model) {
            $type = 1; // Buyer
            if($model->role == 'vendor') {
                $type = 0; // Seller
            }
    
            $area = ServiceArea::find($model->city_id);
            User::create([
                'name' => $model->name,
                'user_type' => $type,
                'phone' => $model->phone, 
                'password' => $model->password,
                'email' => $model->email,
                'otp_code' => $model->code,
                'username' => $model->email,
                'otp_verified' => 1,
                'email_verified' => 1,
                'country_id' => 1,
                'service_area' => $area ? $area->id : null,
                'service_city' => $area ? $area->city->id : null
            ]);
        }

        // Services
        $offset = Service::count(); 
        $services = DB::connection('mysql1')->select("SELECT * FROM services, user_services LIMIT 1000 OFFSET " . $offset);
        foreach ($services as $key => $model) {
            Service::create([
                'title' => $model->title,
                'slug' => Str::slug($model->title),
                'description' => $model->description,
                'status' => $model->active,
                'seller_id' => $model->user_id,
                'price' => $model->price,
                'service_area_id' => $model->city_id,
                'image' => $model->image_1,
                'category_id' => $model->category_id
            ]);
        }
    }
}
