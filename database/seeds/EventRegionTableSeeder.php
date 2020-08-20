<?php

use Illuminate\Database\Seeder;

class EventRegionTableSeeder extends Seeder
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
                'event_id' => '1',
                'region_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => '2',
                'region_id' => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => '3',
                'region_id' => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => '4',
                'region_id' => 5,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => '5',
                'region_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => '6',
                'region_id' => 2,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('event_region')->insert($data);
    }
}
