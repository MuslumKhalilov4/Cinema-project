<?php

namespace Database\Seeders;

use App\Models\Hall;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['Hall 1', 'Hall 2', 'Hall 3'];

        foreach($names as $name){
            Hall::firstOrCreate(['name' => $name]);
        }
    }
}
