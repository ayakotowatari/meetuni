<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        // $this->call(CapacitiesTableSeeder::class);
        // $this->call(CategoriesTableSeeder::class);
        // $this->call(CountriesTableSeeder::class);
        // $this->call(InstsTableSeeder::class);
        // $this->call(InstTypesTableSeeder::class);
        // $this->call(LevelsTableSeeder::class);
        // $this->call(RegionsTableSeeder::class);
        // $this->call(StatusesTableSeeder::class);
        // $this->call(SubjectsTableSeeder::class);
        // $this->call(UserTypesTableSeeder::class);
        // $this->call(YearsTableSeeder::class);

    }
}
