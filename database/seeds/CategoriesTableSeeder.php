<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category' => 'Application Process',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'English Language Assessment',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'Courses',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'Finance',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'Campus Life',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'Accommodation',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'category' => 'Others',
                "created_at" => now(),
                "updated_at" => now(),
            ],

        ];
                DB::table('categories')->insert($data);
    }
}
