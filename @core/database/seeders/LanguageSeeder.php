<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Language;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'slug' => 'english',
            'direction' => 'ltr',
            'default' => 1,
            'status' => "publish"
        ]);
    }
}
