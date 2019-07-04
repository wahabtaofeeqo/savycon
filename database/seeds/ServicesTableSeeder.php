<?php

use Illuminate\Database\Seeder;
use SavyCon\Models\Service;
use SavyCon\Models\Category;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'web development' => [
                'Frontend Development' => 'Frontend Developer',
                'Backend Development' => 'Backend Developer',
            ],
            'design' => [
                'Graphics Design' => 'Graphic Designer',
                'UI/UX Design' => 'UI/UX Designer',
            ],
            'marketing' => [
                'Digital Marketing' => 'Digital Marketer',
            ],
        ];

        foreach ($categories as $name => $category) {
            $category_id = Category::where('name', $name)->first()->id;

            foreach ($category as $name => $title) {
                Service::create([
                    'name' => $name,
                    'title' => $title,
                    'category_id' => $category_id,
                ]);
            }
        }
    }
}
