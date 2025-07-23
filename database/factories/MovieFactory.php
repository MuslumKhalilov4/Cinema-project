<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $movieNames = [
            'Lord of the Rings', 'Star Wars', 'Fight Club', 'X-Men', 'The Prestige',
            'John Wick', 'The Avangers', 'The Chronicles of Narnia', 'Iron Man', 'Guardians of the Galaxy'
        ];
        return [
            'name' => $this->faker->unique()->randomElement($movieNames),
            'description' => $this->faker->paragraph(5),
            'duration' => $this->faker->numberBetween(80, 180),
            'rating' => $this->faker->randomFloat(1, 1.0, 5.0),
            'release_date' => $this->faker->date(),
            'director' => $this->faker->name(),
            'image_path' => 'photo'
        ];
    }
}
