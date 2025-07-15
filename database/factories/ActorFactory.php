<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Actor>
 */
class ActorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'birth_date' => $this->faker->dateTimeBetween('-80 years', '-18 years')->format('Y-m-d'),
            'nationality' => $this->faker->country,
            'height' => $this->faker->numberBetween(150,200),
            'image_path' => 'photo'
        ];
    }
}
