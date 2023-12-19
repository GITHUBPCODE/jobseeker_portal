<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Create multiple job locations using Faker
        for ($i = 0; $i < 10; $i++) {
            Location::create([
                'name' => $faker->city, // Generate job location names using Faker
                // You can add more fields if needed
            ]);
        }
    }
}
