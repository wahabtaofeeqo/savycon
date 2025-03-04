<?php

namespace App\Imports;

use App\User;
use App\ServiceArea;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!$row['name'] || $row['role'] == 'admin') return;

        $type = 1; // Buyer
        if($row['role'] == 'vendor') {
            $type = 0; // Seller
        }

        $area = ServiceArea::find($row['city_id']);
        return new User([
            'name' => $row['name'],
            'user_type' => $type,
            'phone' => $row['phone'], 
            'password' => $row['password'],
            'email' => $row['email'],
            'otp_code' => $row['code'],
            'username' => $row['email'],
            'otp_verified' => 1,
            'email_verified' => 1,
            'country_id' => 1,
            'service_area' => $area ? $area->id : null,
            'service_city' => $area ? $area->city->id : null
        ]);
    }
}
