<?php

namespace App\Imports;

use Str;
use App\Service;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ServicesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Service([
            'title' => $row['title'],
            'slug' => Str::slug($row['title']),
            'description' => $row['description'],
            'status' => $row['active'],
            'seller_id' => $row['user_id'],
            'price' => $row['price'],
            'service_area_id' => $row['city_id'],
            'image' => $row['image_1'],
            'category_id' => $row['category_id']
        ]);
    }
}
