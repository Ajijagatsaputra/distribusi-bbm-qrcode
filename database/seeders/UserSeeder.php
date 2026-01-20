<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'superadmin',
    ]);

    User::create([
        'name' => 'Admin',
        'email' => 'admin@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
    ]);

    User::create([
        'name' => 'Operator',
        'email' => 'operator@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'operator',
    ]);
    }
}
