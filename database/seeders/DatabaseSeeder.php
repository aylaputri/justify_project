<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CategoriesSeeder::class,
            ProductSeeder::class,
            VariantSeeder::class,
            ImageSeeder::class,
            SizeChartSeeder::class,
        ]);
    }
}