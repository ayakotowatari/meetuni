<?php

use Illuminate\Database\Seeder;

class InstsTableSeeder extends Seeder
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
                'name' => 'University of East Anglia',
                'inst_type_id' => 1,
                'country_id' => 1,
                'email_check' => 'something',
                'life' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => "King's College London",
                'inst_type_id' => 1,
                'country_id' => 1,
                'email_check' => 'something',
                'life' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'name' => 'Northumbria University',
                'inst_type_id' => 1,
                'country_id' => 1,
                'email_check' => 'something',
                'life' => 1,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('insts')->insert($data);
    }
}
