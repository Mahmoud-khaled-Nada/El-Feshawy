<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Dr: Mahmoud Nada',
            'email' => 'nada@test.com',
            'password' => '12345678',
        ]);

        $admin->assignRole('superadmin');
    }
}
