<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
//            CompanySeeder::class,
//            ClientSeeder::class,
//            PrescriptionSeeder::class,
//            AddressSeeder::class,
//            SaleSeeder::class
        ]);

//        User::factory(1)->create([
//            'name' => 'Edipo Elwes',
//            'email' => 'edipoelwes2@gmail.com',
//            'company_id' => 1,
//        ]);
    }
}
