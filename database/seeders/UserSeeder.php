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
        User::query()->create([
            'name' => 'Edipo Elwes',
            'email' => 'edipoelwes2@gmail.com',
            'password' => Hash::make('Teste@123'),
            'email_verified_at' => now(),
            'company_id' => 1,
        ]);

        User::query()->create([
            'name' => 'Hitalo Vieira',
            'email' => 'hit_alo_santos@hotmail.com',
            'password' => Hash::make('Jessielly'),
            'email_verified_at' => now(),
            'company_id' => 1,
        ]);
    }
}
