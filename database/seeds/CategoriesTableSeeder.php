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
            'web development',
            'design',
            'marketing'
        ];

        foreach ($categories as $category => $value) {
            Category::create([
                'name' => ucwords($value),
            ]);
        }
    }
}
