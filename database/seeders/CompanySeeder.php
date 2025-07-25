<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::query()->create([
            'name' => 'Fotótica Macêdo',
            'cnpj' => '26.750.337/0001-00',
        ]);
    }
}
