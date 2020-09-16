<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
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
                'user_type' => 'Institution Super Admin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => 'Institution Admin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => NULL,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => 'Student',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('user_types')->insert($data);
    }
}
