<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $maxHealthPoints = $this->faker->numberBetween(10, 50);
        return [
            'name' => $this->faker->name,
            'health_points' => $this->faker->numberBetween(1, $maxHealthPoints),
            'health_points_max' => $maxHealthPoints,
            'power' => $this->faker->numberBetween(1, 10),
            'initiative' => $this->faker->numberBetween(1, 10),
            'intelligence' => $this->faker->numberBetween(1, 10),
            'lvl' => $this->faker->numberBetween(1, 5),
            'protection' => $this->faker->numberBetween(1, 10),
        ];
    }
}
