<?php

use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
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
                'id' => 30,
                'country_id' => 4,
                'year_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => 31,
                'country_id' => 1,
                'year_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => 32,
                'country_id' => 2,
                'year_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => 33,
                'country_id' => 3,
                'year_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'id' => 34,
                'country_id' => 4,
                'year_id' => 3,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('students')->insert($data);
    }
}
