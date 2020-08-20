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
                'country' => 'China',
                'region_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'United States',
                'region_id' => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'country' => 'Brazil',
                'region_id' => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('countries')->insert($data);
    }
}
