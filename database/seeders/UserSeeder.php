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
            'id' => '1',
            'name' => 'Fajar Chan',
            'email' => 'fajarrivaldi2015@gmail.com',
            'phone' => '0895611024559',
            'password' => Hash::make('password'),
        ]);
    }
}
