<?php

use Illuminate\Database\Seeder;

class eventsTableSeeder extends Seeder
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
                'title' => 'Information Session',
                'inst_id' => 7,
                'date' => '2020-10-28',
                'start_time' => '09:00',
                'end_time' => '10:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 1,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'title' => 'Welcome to UEA',
                'inst_id' => 7,
                'date' => '2020-11-28',
                'start_time' => '10:00',
                'end_time' => '11:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 3,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'title' => 'Information Session',
                'inst_id' => 7,
                'date' => '2020-7-14',
                'start_time' => '09:00',
                'end_time' => '10:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 5,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'title' => 'PG study at UEA',
                'inst_id' => 7,
                'date' => '2020-12-08',
                'start_time' => '09:00',
                'end_time' => '10:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 3,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'title' => 'Information Session',
                'inst_id' => 7,
                'date' => '2020-10-03',
                'start_time' => '10:00',
                'end_time' => '11:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 1,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'title' => 'Campus Life in UEA',
                'inst_id' => 7,
                'date' => '2020-11-28',
                'start_time' => '09:00',
                'end_time' => '10:00',
                "details" => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
                "img" => '',
                "capacity_id" => 1,
                "status_id" => 3,
                "inst_user_id" => 9,
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('events')->insert($data);
    }
}
