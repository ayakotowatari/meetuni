<?php

use Illuminate\Database\Seeder;

class CapacitiesTableSeeder extends Seeder
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
                'capacity' => 'available',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'capacity' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'capacity' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'capacity' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'capacity' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'capacity' => 'full',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('capacities')->insert($data);
    }
}
