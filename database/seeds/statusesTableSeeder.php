<?php

use Illuminate\Database\Seeder;

class statusesTableSeeder extends Seeder
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
                'status' => 'Ongoing',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Draft',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'status' => 'Complete',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('statuses')->insert($data);
    }
}
