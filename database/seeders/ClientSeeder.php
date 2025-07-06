<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();

        if ($companies->isEmpty()) {
            $this->command->warn('No companies found. Run CompanySeeder first.');
            return;
        }

        $clients = Client::factory()->count(1000)->create();

        foreach ($clients as $client) {
            $randomCompanies = $companies->random(rand(1, min(2, $companies->count())))->pluck('id');
            $client->companies()->attach($randomCompanies);
        }
    }
}
