<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_categories')->insert([
            [
                'category_name' => 'Dress',
            ],
            [
                'category_name' => 'Crop top',
            ],
            [
                'category_name' => 'Off-Shoulder',
            ],
            [
                'category_name' => 'Blouse',
            ],
            [
                'category_name' => 'Tanktop',
            ],
            [
                'category_name' => 'Corset',
            ],
            [
                'category_name' => 'T-Shirt',
            ],
            [
                'category_name' => 'Shirt',
            ],
            [
                'category_name' => 'Jeans',
            ],
            [
                'category_name' => 'Skirt',
            ],
            [
                'category_name' => 'Skort',
            ],
            [
                'category_name' => 'Shorts',
            ],
            [
                'category_name' => 'Cargo',
            ],
            [
                'category_name' => 'Ripped jeans',
            ],
        ]);
    }
}