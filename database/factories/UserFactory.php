<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = now();
        $first_name = $this->faker->firstName();
        $last_name = $this->faker->lastName();
        return [

            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $first_name . $last_name . $date . 'gmail.com',
            'hourly_rate' => $this->faker->numberBetween(50, 999),
            'password' => Hash::make('12345678'),
        ];
    }
}
