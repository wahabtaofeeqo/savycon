<?php

namespace App\Imports;

use App\Country;
use App\ServiceArea;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServiceAreaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $country = Country::first();
        if($row['name']) {
            return new ServiceArea([
                'country_id' => $country->id,
                'service_area' => $row['name'],
                'service_city_id' => $row['state_id']
            ]);
        }
    }
}
