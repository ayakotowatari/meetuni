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
                'user_type' => 'Admin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => 'University Admin',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => 'Student',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type' => '',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('user_types')->insert($data);
    }
}
