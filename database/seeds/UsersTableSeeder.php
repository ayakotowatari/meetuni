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
                    'user_type_id' => 5,
                    'first_name' => 'Tracey',
                    'last_name' => 'Hearn',
                    'email' => 'tracey@test.com',
                    'password' => Hash::make('testtracey'),
                    'life' => 1,
                    'remember_token' => '1234567890abcdefg',
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    'user_type_id' => 5,
                    'first_name' => 'Emma',
                    'last_name' => 'Parker',
                    'email' => 'emma@test.com',
                    'password' => Hash::make('testemma'),
                    'life' => 1,
                    'remember_token' => '1234567890abcdefg',
                    "created_at" => now(),
                    "updated_at" => now()
                ],
                [
                    'user_type_id' => 9,
                    'first_name' => 'Ayako',
                    'last_name' => 'Towatari',
                    'email' => 'ayako@test.com',
                    'password' => Hash::make('testayako'),
                    'life' => 1,
                    'remember_token' => '1234567890abcdefg',
                    "created_at" => now(),
                    "updated_at" => now()
                ],
            ];
            DB::table('users')->insert($data);
        }
}
