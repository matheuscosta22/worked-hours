<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($a = 0; $a < 1000; $a++) {
            $date = now();
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $user = DB::table('users')->insert([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $first_name . $last_name . $date .'gmail.com',
                'hourly_rate' => $faker->numberBetween(50, 999),
                'password' => Hash::make('12345678'),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    } 
}
