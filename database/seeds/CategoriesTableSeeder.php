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
            'software development' => [
                'Frontend Development',
                'Backend Development',
                'Mobile App Development',
                'Desktop App Development',
            ],

            'design' => [
                'Graphics Design',
                'UI/UX Design',
            ],

            'marketing' => [
                'Digital Marketing',
                'Content Marketing',
                'Social Media Marketing',
                'Field Marketing',
                'Affiliate Marketing',
            ],

            'accounting' => [
                'Accounting',
            ],

            'consultancy' => [
                'Consultancy',
            ],

            'fashion' => [
                'Fashion Design',
                'Tailoring',
                'Modelling',
            ],

            'law' => [
                'Criminal Law',
                'Corporate Law',
                'International Law',
                'Civil Law',
            ],
        ];

        foreach ($categories as $category => $value) {
            Category::create([
                'name' => ucwords($category),
            ]);
        }
    }
}