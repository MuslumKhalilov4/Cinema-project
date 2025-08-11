<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            GenreSeeder::class,
            ActorSeeder::class,
            MovieSeeder::class,
            LanguageSeeder::class,
            HallSeeder::class,
            SeatSeeder::class,
        ]);
    }
}
