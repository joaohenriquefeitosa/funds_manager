<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Fund;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            $company = Company::create([
                'name' => $faker->company,
            ]);

            $numberOfFunds = rand(1, 3);
            $fundIds = Fund::inRandomOrder()->limit($numberOfFunds)->pluck('id');
            $company->funds()->attach($fundIds);
        }
    }
}
