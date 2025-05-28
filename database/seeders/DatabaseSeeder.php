<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (Service::count() < 300) {
            Service::factory(300)->create();
        }
        User::firstOrCreate(
            ['email' => 'admin@sheba.xyz',],
            [
                'name' => 'Admin',
                'email' => 'admin@sheba.xyz',
                'password' => Hash::make('password'),
            ]
        );
    }
}
