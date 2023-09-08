<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CompaniesTableSeeder::class);
        $this->call(FundManagersTableSeeder::class);
        $this->call(FundsTableSeeder::class);
        $this->call(AliasesTableSeeder::class);
    }
}
