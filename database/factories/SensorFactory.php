<?php

namespace Database\Factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class SensorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number'      => $this->faker->numberBetween(1, 10000),
            'face'        => $this->faker->randomElement(['north', 'east', 'south', 'west']),
            'temperature' => $this->faker->randomFloat(2, 30.00, 33.99),
            'created_at'  => $this->faker->unixTime(new DateTime('-3 weeks')),
         ];
    }
}
