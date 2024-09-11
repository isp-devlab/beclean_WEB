<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'id' => '1',
            'name' => 'Daur Ulang',
        ]);
        ProductCategory::create([
            'id' => '2',
            'name' => 'Rumah Tangga',
        ]);
    }
}
