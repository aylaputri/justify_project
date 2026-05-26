<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {

        $categories = [

            'Dress',
            'Crop top',
            'Off-Shoulder',
            'Blouse',
            'Tanktop',
            'Corset',
            'T-Shirt',
            'Shirt',
            'Jeans',
            'Skirt',
            'Skort',
            'Shorts',
            'Cargo',
            'Ripped jeans',

        ];

        foreach ($categories as $category) {

            DB::table('product_categories')
                ->updateOrInsert(

                    [
                        'category_name' => $category
                    ],

                );

        }

    }
}