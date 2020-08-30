<?php

use Illuminate\Database\Seeder;

class CountryStudentsTableSeeder extends Seeder
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
                'student_id' => 30,
                'country_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 30,
                'country_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 31,
                'country_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 31,
                'country_id' => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 32,
                'country_id' => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 32,
                'country_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 33,
                'country_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 34,
                'country_id' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'student_id' => 34,
                'country_id' => 4,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
        DB::table('country_students')->insert($data);
    }
}
