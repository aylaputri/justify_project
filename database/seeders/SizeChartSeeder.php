<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SizeChart;

class SizeChartSeeder extends Seeder
{
    public function run(): void
    {
        SizeChart::truncate();
        
        $sizeCharts = [

            // 1. Dress
            [
                'id_category' => 1,
                'size' => 'M',
                'length_cm' => 68,
                'width_cm' => 44
            ],
            [
                'id_category' => 1,
                'size' => 'L',
                'length_cm' => 72,
                'width_cm' => 46
            ],

            // 2. Crop top
            [
                'id_category' => 2,
                'size' => 'S',
                'length_cm' => 40,
                'width_cm' => 34
            ],
            [
                'id_category' => 2,
                'size' => 'M',
                'length_cm' => 44,
                'width_cm' => 36
            ],

            // 3. Off-Shoulder
            [
                'id_category' => 3,
                'size' => 'S',
                'length_cm' => 45,
                'width_cm' => 38
            ],
            [
                'id_category' => 3,
                'size' => 'M',
                'length_cm' => 48,
                'width_cm' => 40
            ],

            // 4. Blouse
            [
                'id_category' => 4,
                'size' => 'M',
                'length_cm' => 65,
                'width_cm' => 42
            ],
            [
                'id_category' => 4,
                'size' => 'L',
                'length_cm' => 69,
                'width_cm' => 45
            ],

            // 5. Tanktop
            [
                'id_category' => 5,
                'size' => 'S',
                'length_cm' => 50,
                'width_cm' => 30
            ],
            [
                'id_category' => 5,
                'size' => 'M',
                'length_cm' => 54,
                'width_cm' => 32
            ],

            // 6. Corset
            [
                'id_category' => 6,
                'size' => 'S',
                'length_cm' => 35,
                'width_cm' => 32
            ],
            [
                'id_category' => 6,
                'size' => 'M',
                'length_cm' => 38,
                'width_cm' => 34
            ],

            // 7. T-Shirt
            [
                'id_category' => 7,
                'size' => 'M',
                'length_cm' => 70,
                'width_cm' => 46
            ],
            [
                'id_category' => 7,
                'size' => 'L',
                'length_cm' => 74,
                'width_cm' => 48
            ],

            // 8. Shirt
            [
                'id_category' => 8,
                'size' => 'M',
                'length_cm' => 72,
                'width_cm' => 45
            ],
            [
                'id_category' => 8,
                'size' => 'L',
                'length_cm' => 76,
                'width_cm' => 47
            ],

            // 9. Jeans
            [
                'id_category' => 9,
                'size' => 'S',
                'length_cm' => 98,
                'width_cm' => 72
            ],
            [
                'id_category' => 9,
                'size' => 'M',
                'length_cm' => 102,
                'width_cm' => 76
            ],

            // 10. Skirt
            [
                'id_category' => 10,
                'size' => 'S',
                'length_cm' => 40,
                'width_cm' => 68
            ],
            [
                'id_category' => 10,
                'size' => 'M',
                'length_cm' => 44,
                'width_cm' => 72
            ],

            // 11. Skort
            [
                'id_category' => 11,
                'size' => 'S',
                'length_cm' => 38,
                'width_cm' => 70
            ],
            [
                'id_category' => 11,
                'size' => 'M',
                'length_cm' => 42,
                'width_cm' => 74
            ],

            // 12. Shorts
            [
                'id_category' => 12,
                'size' => 'S',
                'length_cm' => 42,
                'width_cm' => 72
            ],
            [
                'id_category' => 12,
                'size' => 'M',
                'length_cm' => 45,
                'width_cm' => 76
            ],

            // 13. Cargo
            [
                'id_category' => 13,
                'size' => 'S',
                'length_cm' => 100,
                'width_cm' => 74
            ],
            [
                'id_category' => 13,
                'size' => 'M',
                'length_cm' => 104,
                'width_cm' => 78
            ],

            // 14. Ripped jeans
            [
                'id_category' => 14,
                'size' => 'S',
                'length_cm' => 99,
                'width_cm' => 73
            ],
            [
                'id_category' => 14,
                'size' => 'M',
                'length_cm' => 103,
                'width_cm' => 77
            ],

        ];

        foreach ($sizeCharts as $chart) {

            SizeChart::updateOrCreate(

                [
                    'id_category' => $chart['id_category'],
                    'size' => $chart['size']
                ],

                [
                    'length_cm' => $chart['length_cm'],
                    'width_cm' => $chart['width_cm']
                ]
            );
        }
    }
}