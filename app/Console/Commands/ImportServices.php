<?php

namespace SavyCon\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Rap2hpoutre\FastExcel\FastExcel;
use SavyCon\Models\State;
use SavyCon\Models\City;
use SavyCon\Models\Category;
use SavyCon\Models\Service;
use SavyCon\Models\User;
use SavyCon\Models\UserService;

class ImportServices extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'i:s {file} {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $this->output->title('Importing...' . date("Y-m-d H:i:s"));

        $this->state_id = $this->argument('id');
        $services = (new FastExcel)->import(public_path('states/state_' . $this->argument('file') . ' edited.csv'), function ($row) {
            UserService::create([
                'title' => $row['BusinessName'],
                'description' => $row['ShortDesc'],
                'address' => $row['FullAddress'],
                'landmark' => $row['Landmark'],
                'user_id' =>
                empty(User::where('name', $row['ContactPerson'])->where('email', $row['Email'])->first()) ?
                empty(User::where('name', $row['ContactPerson'])->where('phone', $row['Phone'])->first()) ?
                User::create([
                    'name' => $row['ContactPerson'] ? $row['ContactPerson'] : 'John Doe',
                    'email' => empty(User::where('email', $row['Email'])->first()) ? ($row['Email'] === 'nan' ?
                    'savycon' . rand(1, 1000000) . 'freelance' . rand(1, 1000000) . '@gmail.com' :
                    $row['Email']) ? $row['Email'] : 'savycon' . rand(1, 1000000) . 'freelance' . rand(1, 1000000) . '@gmail.com' :
                    'savycon' . rand(1, 1000000) . 'freelance' . rand(1, 1000000) . '@gmail.com',
                    'password' => Hash::make($row['ContactPerson'] ? $row['ContactPerson'] : 'John Doe'),
                    'phone' => ($row['Phone'] === 'nan') ? '8001002000' : substr($row['Phone'] ? $row['Phone'] : '8001002000', 1),
                    'role' => 'vendor',
                    'city_id' => empty(City::where('name', $row['City'])->first()) ? City::create([
                        'name' => $row === 'nan' ?
                        State::find($this->state_id)->name . rand(1, 1000000) :
                        $row['City'],
                        'state_id' => $this->state_id])->id :
                    City::where('name', $row['City'])->first()->id,])->id :
                User::where('name', $row['ContactPerson'])->where('phone', $row['Phone'] ? $row['Phone'] : '810000000')->first()->id :
                User::where('name', $row['ContactPerson'])->where('email', $row['Email'] ? $row['Email'] : 'savycon' . rand(1, 1000000) . 'freelance' . rand(1, 1000000) . '@gmail.com')->first()->id,
                'city_id' => City::firstOrCreate(
                        ['name' => $row['City']],
                        [
                            'name' => $row['City'],
                            'state_id' => $this->state_id
                        ]
                )->id, 'service_id' =>
                empty(Service::where('name', $row['Category'] ? $row['Category'] : 'nan')->first()) ? Service::create([
                    'name' => ($row['Category'] === 'nan' ? 'Category' . rand(1, 1000000) : $row['Category']) ? $row['Category'] : 'nan',
                    'category_id' => empty(Category::where('name', ((strpos($row['Category'] ? $row['Category'] : 'nan', ',') !== false) ? explode(',', $row['Category'] ? $row['Category'] : 'nan')[0] : $row['Category']) ? $row['Category'] : 'nan')
                                    ->first()) ?
                    Category::create([
                        'name' => ((strpos($row['Category'] ? $row['Category'] : 'nan', ',') !== false) ?
                        explode(',', $row['Category'] ? $row['Category'] : 'nan')[0] : $row['Category']) ? $row['Category'] : 'nan'])->id :
                    Category::where('name', ((strpos($row['Category'] ? $row['Category'] : 'nan', ',') !== false) ? explode(',', $row['Category'] ? $row['Category'] : 'nan')[0] : $row['Category']) ? $row['Category'] : 'nan')
                            ->first()->id,
                ])->id : Service::where('name', $row['Category'] ? $row['Category'] : 'nan')->first()->id,
            ]);
        });

        $this->output->success('Import Complete! ' . date("Y-m-d H:i:s"));
    }

}
