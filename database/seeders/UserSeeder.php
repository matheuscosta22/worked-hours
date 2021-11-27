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
            $user = DB::table('users')->insert([
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'email' => rand(10000000, 99999999) . '@gmail.com',
                'hourly_rate' => rand(10, 999),
                'password' => Hash::make('asdfasdf'),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    } 
}
