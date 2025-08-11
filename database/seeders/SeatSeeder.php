<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = 4;
        $seat_per_row = 4;
        $hall_ids = Hall::pluck('id');

        foreach ($hall_ids as $hall_id) {
            for($i = 1; $i <= $rows; $i++){
                for ($j = 1; $j <= $seat_per_row; $j++) {
                    Seat::create([
                        'row' => $i,
                        'number' => $j,
                        'is_reserved' => false,
                        'hall_id' => $hall_id
                    ]);
                }
            }
        }
    }
}
