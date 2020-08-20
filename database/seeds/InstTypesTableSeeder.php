<?php

use Illuminate\Database\Seeder;

class InstTypesTableSeeder extends Seeder
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
                'inst_type' => 'university',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('inst_types')->insert($data);
    }
}
