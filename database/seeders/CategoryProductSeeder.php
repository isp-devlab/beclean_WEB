<?php

namespace Database\Seeders;

use App\Models\productCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        productCategory::create([
            'id' => '1',
            'name' => 'Daur Ulang',
        ]);
        productCategory::create([
            'id' => '2',
            'name' => 'Basah',
        ]);
    }
}
