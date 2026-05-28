<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SizeChart;

class SizeChartSeeder extends Seeder
{
    public function run(): void
    {
        $sizeCharts = [

            // DRESS
            [
                'id_category' => 1,
                'size' => 'S',
                'height_cm' => 64,
                'shoulder_width_cm' => 40
            ],

            [
                'id_category' => 1,
                'size' => 'M',
                'height_cm' => 68,
                'shoulder_width_cm' => 44
            ],

            [
                'id_category' => 1,
                'size' => 'L',
                'height_cm' => 72,
                'shoulder_width_cm' => 46
            ],

            // CROP TOP
            [
                'id_category' => 2,
                'size' => 'S',
                'height_cm' => 60,
                'shoulder_width_cm' => 38
            ],

            [
                'id_category' => 2,
                'size' => 'M',
                'height_cm' => 64,
                'shoulder_width_cm' => 41
            ],

            // SHIRT
            [
                'id_category' => 8,
                'size' => 'M',
                'height_cm' => 70,
                'shoulder_width_cm' => 45
            ],

            [
                'id_category' => 8,
                'size' => 'L',
                'height_cm' => 74,
                'shoulder_width_cm' => 48
            ],

        ];

        foreach ($sizeCharts as $chart) {

            SizeChart::updateOrCreate(

                [
                    'id_category' => $chart['id_category'],
                    'size' => $chart['size']
                ],

                [
                    'height_cm' => $chart['height_cm'],
                    'shoulder_width_cm' => $chart['shoulder_width_cm']
                ]

            );
        }
    }
}