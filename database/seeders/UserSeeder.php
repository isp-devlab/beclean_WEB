<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Fajar Chan',
            'email' => 'fajarrivaldi2015@gmail.com',
            'phone' => '0895611024559',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jhon Doe',
            'email' => 'john.doe@example.com',
            'phone' => '08956110876543',
            'role' => 'driver',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane.doe@example.com',
            'phone' => '08956110876564',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);
    }
}
