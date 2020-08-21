<?php

use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
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
                'subject' => 'All',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Agricultural Studies',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Architecture, Building and Urban Planning',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Education and Training',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Science and Engineering',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Health and Medicine',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'MBA',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Social Science and Communications',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Applied and Pure Sciences',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Business and Administrations',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Art and Design',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'English as Foreign Language',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Legal Studies',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Arts and Humanities',
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                'subject' => 'Travel, Tourism and Hospitality',
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ];
                DB::table('subjects')->insert($data);
    }
}
