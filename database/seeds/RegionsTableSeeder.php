<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
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
                'region' => 'Europe',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'region' => 'Asia',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('regions')->insert($data);
    }
}
