<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TemperatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'temperature' => $this->faker->randomFloat(1, 30.0, 33.9),
            'faulty'      => $this->faker->boolean(0),
            'created_at'  => $this->faker->dateTimeBetween('2022-06-23 11:08:02', "2022-06-26 12:30:02"),
            'sensor_id'   => $this->faker->numberBetween(0, 15),
        ];
    }
}
