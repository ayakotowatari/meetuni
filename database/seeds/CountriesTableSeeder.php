<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
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
                'country' => 'UK',
                'region_id' => 1,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Japan',
                'region_id' => 2,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'United States',
                'region_id' => 3,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Canada',
                'region_id' => 3,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Taiwan',
                'region_id' => 2,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'South Korea',
                'region_id' => 2,
                'destination' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Mexico',
                'region_id' => 3,
                'destination' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Argentina',
                'region_id' => 3,
                'destination' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('countries')->insert($data);
    }
}
