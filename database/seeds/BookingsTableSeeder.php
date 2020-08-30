<?php

use Illuminate\Database\Seeder;

class BookingsTableSeeder extends Seeder
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
                'event_id' => 85,
                'student_id' => 30,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 86,
                'student_id' => 30,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 85,
                'student_id' => 31,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 86,
                'student_id' => 31,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 85,
                'student_id' => 32,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 86,
                'student_id' => 32,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 85,
                'student_id' => 33,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 86,
                'student_id' => 33,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 85,
                'student_id' => 34,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'event_id' => 86,
                'student_id' => 34,
                'cancelled' => 0,
                "created_at" => now(),
                "updated_at" => now(),
            ]
        ];
                DB::table('bookings')->insert($data);
    }
}
