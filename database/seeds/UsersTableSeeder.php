<?php

use Illuminate\Database\Seeder;
use SavyCon\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User();
        $admin->name = 'Adeyinka Adefolurin';
        $admin->email = 'folurinyinka@gmail.com';
        $admin->password = bcrypt('microsoft');
        $admin->email_verified_at = now();
        $admin->phone = '8135303377';
        $admin->role = 'admin';
        $admin->save();

        $admin = new User();
        $admin->name = 'SavyCon Admin';
        $admin->email = 'admin@savycon.com';
        $admin->password = bcrypt('savycon-admin');
        $admin->email_verified_at = now();
        $admin->phone = '8062081641';
        $admin->role = 'admin';
        $admin->save();

        $admin = new User();
        $admin->name = 'Wahab Taofeek';
        $admin->email = 'taofeekolamilekan218@yahoo.com';
        $admin->password = bcrypt('domain');
        $admin->email_verified_at = now();
        $admin->phone = '8136974417';
        $admin->role = 'admin';
        $admin->save();
    }
}
