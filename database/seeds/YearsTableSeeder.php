<?php

use Illuminate\Database\Seeder;

class YearsTableSeeder extends Seeder
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
                'year' => 2021,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'year' => 2022,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'year' => 2023,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'year' => 2024,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'year' => 2025,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
                DB::table('years')->insert($data);
    }
}
