<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
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
                'user_type_id' => 1,
                'first_name' => 'Tracey',
                'last_name' => 'Hearn',
                'email' => 'tracey@test.com',
                'password' => Hash::make('testtracey'),
                'timezone' => 'Asia/Tokyo',
                'inst_id' => 1,
                'job_title' => 'Manager',
                'department' => 'International Office',
                'life' => 1,
                'remember_token' => '1234567890abcdefg',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type_id' => 1,
                'first_name' => 'Gs',
                'last_name' => 'Test',
                'email' => 'gs@test.com',
                'password' => Hash::make('testgs'),
                'timezone' => 'Asia/Tokyo',
                'inst_id' => 1,
                'job_title' => 'Manager',
                'department' => 'International Office',
                'life' => 1,
                'remember_token' => '1234567890abcdefg',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type_id' => 1,
                'first_name' => 'Kyota',
                'last_name' => 'Ueda',
                'email' => 'kyota@test.com',
                'password' => Hash::make('testkyota'),
                'timezone' => 'Asia/Tokyo',
                'inst_id' => 2,
                'job_title' => 'Manager',
                'department' => 'International Office',
                'life' => 1,
                'remember_token' => '1234567890abcdefg',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'user_type_id' => 1,
                'first_name' => 'Andrew',
                'last_name' => 'Lane',
                'email' => 'andrew@test.com',
                'password' => Hash::make('testandrew'),
                'timezone' => 'Asia/Tokyo',
                'inst_id' => 3,
                'job_title' => 'Manager',
                'department' => 'International Office',
                'life' => 1,
                'remember_token' => '1234567890abcdefg',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            
        ];
                DB::table('users')->insert($data);
    }
}
