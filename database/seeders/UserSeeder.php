<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Edipo Elwes',
            'email' => 'edipoelwes2@gmail.com',
            'company_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Hitalo Vieira',
            'email' => 'hit_alo_santos@hotmail.com',
            'password' => Hash::make('Jessielly'),
            'company_id' => 1,
        ]);
    }
}
