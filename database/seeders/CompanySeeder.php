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
            'name' => 'Fotoótica Macêdo',
            'cnpj' => '12.345.678/0001-90',
        ]);

        Company::query()->create([
            'name' => 'Ótica Silvia',
            'cnpj' => '98.765.432/0001-10',
        ]);
    }
}
