<?php

use Illuminate\Database\Seeder;

class TestformsTableSeeder extends Seeder
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
                'name' => 'Ayako Towatari',
                'email' => 'ayako@test.com',
                "created_at" => now(),
                "updated_at" => now()
            ],
            [
                'name' => 'Kyota Ueda',
                'email' => 'kyota@test.com',
                "created_at" => now(),
                "updated_at" => now()
            ],
        ];
                DB::table('testforms')->insert($data);
    }
}
