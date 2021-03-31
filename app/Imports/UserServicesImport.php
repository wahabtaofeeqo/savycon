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
// use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

//WithBatchInserts, WithChunkReading, SkipsOnFailure, SkipsOnError
class UserServicesImport implements ToModel, WithHeadingRow
{
    use Importable, SkipsFailures, SkipsErrors;

    protected $state_id;

    /**
    *   @param state's name
    */
    public function __construct($id) {
        $this->state_id = $id;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) {

        $check = UserService::where('title', $row['businessname'])->first();
        $state = State::where('name', $row['state'])->first();

        $second_phone = ($row['secondphone'] === 'nan') ? '' : substr($row['secondphone'] ? $row['secondphone'] : '8001002000', 1);
        
        if (empty($check)) {
            return new UserService([

                'title' => $row['businessname'],
                'description' => $row['shortdesc'],
                'address' => $row['fulladdress'],
                'landmark' => $row['landmark'],
                'user_id' =>
                    empty(User::where('name', $row['contactperson'])->where('email', $row['email'])->first())
                    ?
                        empty(User::where('name', $row['contactperson'])->where('phone', $row['phone'])->first())
                        ?
                            User::create([
                                'name' => $row['contactperson'] ? $row['contactperson'] : 'John Doe',
                                'email' => 
                                    empty(User::where('email', $row['email'])->first())
                                    ?
                                        $row['email'] === 'nan'
                                        ?
                                            'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com'
                                        :
                                            $row['email'] ? $row['email'] : 'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com'
                                    :
                                        'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com'
                                ,
                                'password' => Hash::make($row['contactperson'] ? $row['contactperson'] : 'John Doe'),
                                'phone' => ($row['phone'] === 'nan') ? '8001002000' : substr($row['phone'] ? $row['phone'] : '8001002000', 1),
                                'second_phone' => $second_phone,
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
                                            'state_id' => $state->id
                                        ])->id
                                    :   
                                        City::where('name', $row['city'])->first()->id
                                ,
                            ])->id
                        :
                            User::where('name', $row['contactperson'])->where('phone', $row['phone'] ? $row['phone'] : '810000000')->first()->id
                    : 
                        User::where('name', $row['contactperson'])->where('email', $row['email'] ? $row['email'] : 'savycon'.rand(1,1000000).'freelance'.rand(1,1000000).'@gmail.com')->first()->id
                ,
                'city_id' => City::firstOrCreate(
                                    ['name' => $row['city']],
                                    [
                                        'name' => $row['city'],
                                        'state_id' => $state->id
                                    ]
                                )->id
                ,
                'service_id' => 
                    empty(Service::where('name', $row['category'] ? $row['category'] : 'nan')->first())
                    ?   Service::create([
                            'name' => 
                                $row['category'] === 'nan'
                                ?   
                                    'Category'.rand(1,1000000)
                                :   
                                    $row['category'] ? $row['category'] : 'nan'
                            ,
                            'category_id' => 
                                empty(Category::where('name', (strpos($row['category'] ? $row['category'] : 'nan', ',') !== false) ? explode(',', $row['category'] ? $row['category'] : 'nan')[0] : $row['category'] ? $row['category'] : 'nan')
                                    ->first())
                                ?
                                    Category::create([
                                        'name' => (strpos($row['category'] ? $row['category'] : 'nan', ',') !== false)
                                        ?
                                            explode(',', $row['category'] ? $row['category'] : 'nan')[0]
                                        :
                                            $row['category'] ? $row['category'] : 'nan'
                                    ])->id
                                :
                                    Category::where('name', (strpos($row['category'] ? $row['category'] : 'nan', ',') !== false) ? explode(',', $row['category'] ? $row['category'] : 'nan')[0] : $row['category'] ? $row['category'] : 'nan')
                                    ->first()->id
                            ,
                        ])->id
                    :   Service::where('name', $row['category'] ? $row['category'] : 'nan')->first()->id
                ,
            ]);
        }
        
    }

    public function batchSize(): int
    {
        return 1;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
