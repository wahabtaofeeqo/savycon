<?php

use Illuminate\Database\Seeder;
use SavyCon\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'software development',
            'design',
            'marketing',
            'fashion',
            'accounting', 
            'consultancy',
            'law'
        ];

        foreach ($categories as $category => $value) {
            Category::create([
                'name' => ucwords($value),
            ]);
        }
    }
}
