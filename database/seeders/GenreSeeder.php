<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Comedy',
            'Action',
            'Drama',
            'Romance',
            'Thriller'
        ];

        foreach($genres as $genre){
            Genre::firstOrCreate(['name' => $genre]);
        }
    }
}
