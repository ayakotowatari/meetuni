<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
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
                'level' => 'All',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => 'Undergraduate',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => 'Postgraduate',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'level' => 'MBA',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('levels')->insert($data);
    }
}
