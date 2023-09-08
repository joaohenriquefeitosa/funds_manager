<?php

namespace Database\Seeders;

use App\Models\Fund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $index) {
            Fund::create([
                'name' => $faker->company,
                'start_year' => $faker->year,
                'manager_id' => $faker->numberBetween(1, 10), // Assuming you have 10 fund managers
            ]);
        }
    }
}
