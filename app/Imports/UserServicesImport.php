<?php

namespace SavyCon\Imports;

use SavyCon\Models\State;
use SavyCon\Models\City;
use SavyCon\Models\Category;
use SavyCon\Models\Service;
use SavyCon\Models\User;
use SavyCon\Models\UserService;

use Illuminate\Support\Facades\Hash;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class UserServicesImport implements ToModel, WithHeadingRow, WithProgressBar, WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError
{
    use Importable, SkipsFailures, SkipsErrors;

    protected $state_id;

    /**
    *   @param state's name
    */
    public function __construct($state)
    {
        $this->state_id = State::where('name', $state)->first()->id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new UserService([
            'title' => $row['businessname'],
            'description' => $row['shortdesc'],
            'address' => $row['houseno'].', '.$row['address1'].', '.$row['area'].', '.$row['landmark'],
            'user_id' =>
                empty(User::where('name', $row['contactperson'])->where('email', $row['email'])->first())
                ?
                    empty(User::where('name', $row['contactperson'])->where('phone', $row['phone'])->first())
                    ?
                        User::create([
                            'name' => $row['contactperson'],
                            'email' => 
                                empty(User::where('email', $row['email'])->first())
                                ?
                                    $row['email'] === 'nan'
                                    ?
                                        'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com'
                                    :
                                        $row['email']
                                :
                                    'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com'
                            ,
                            'password' => Hash::make($row['contactperson']),
                            'phone' => ($row['phone'] === 'nan') ? '8001002000' : substr($row['phone'], 1),
                            'role' => 'vendor',
                            'city_id' => 
                                empty(City::where('name', $row['city'])->first())
                                ?   
                                    City::create([
                                        'name' => 
                                            $row === 'nan'
                                            ?   
                                                State::find($this->state_id)->name.rand(1,1000000)
                                            :   
                                                $row['city']
                                        ,
                                        'state_id' => $this->state_id
                                    ])->id
                                :   
                                    City::where('name', $row['city'])->first()->id
                            ,
                        ])->id
                    :
                        User::where('name', $row['contactperson'])->where('phone', $row['phone'])->first()->id
                : 
                    User::where('name', $row['contactperson'])->where('email', $row['email'])->first()->id
            ,
            'city_id' => empty(City::where('name', $row['city'])->first())
                ?   City::create([
                        'name' => $row['city'],
                        'state_id' => $this->state_id
                    ])->id
                :   City::where('name', $row['city'])->first()->id
            ,
            'service_id' => 
                empty(Service::where('name', $row['category'])->first())
                ?   Service::create([
                        'name' => 
                            $row['category'] === 'nan'
                            ?   
                                'Category'.rand(1,1000000)
                            :   
                                $row['category']
                        ,
                        'category_id' => 
                            empty(Category::where('name', (strpos($row['category'], ',') !== false) ? explode(',', $row['category'])[0] : $row['category'])
                                ->first())
                            ?
                                Category::create([
                                    'name' => (strpos($row['category'], ',') !== false)
                                    ?
                                        explode(',', $row['category'])[0]
                                    :
                                        $row['category']
                                ])->id
                            :
                                Category::where('name', (strpos($row['category'], ',') !== false) ? explode(',', $row['category'])[0] : $row['category'])
                                ->first()->id
                        ,
                    ])->id
                :   Service::where('name', $row['category'])->first()->id
            ,
        ]);
    }

    public function batchSize(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 10000;
    }
}
