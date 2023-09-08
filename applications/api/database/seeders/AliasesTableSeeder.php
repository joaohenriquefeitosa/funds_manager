<?php

namespace Database\Seeders;

use App\Models\Alias;
use App\Models\Fund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AliasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Get all funds to associate aliases with
        $funds = Fund::all();

        foreach ($funds as $fund) {
            $aliasCount = $faker->numberBetween(1, 5); // Random number of aliases per fund

            for ($i = 0; $i < $aliasCount; $i++) {
                Alias::create([
                    'alias' => $faker->company, // You can customize this based on your alias model
                    'fund_id' => $fund->id,
                ]);
            }
        }
    }
}
