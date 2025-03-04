<?php

namespace App\Imports;

use App\Country;
use App\ServiceCity;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServiceCityImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $country = Country::first();
        return new ServiceCity([
            'country_id' => $country->id,
            'service_city' => $row['name']
        ]);
    }
}
