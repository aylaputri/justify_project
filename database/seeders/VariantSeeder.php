<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    public function run(): void
    {

        $variants = [
            // 1. Ribbed Ribbon Crop Top
            [
                'id_product' => 1,
                'color' => 'White',
                'size' => 'M',
                'price' => 125000,
                'stock' => 15,
                'status' => 'Ready',
            ],
            [
                'id_product' => 1,
                'color' => 'White',
                'size' => 'L',
                'price' => 125000,
                'stock' => 10,
                'status' => 'Ready',
            ],

            // 2. 3D Floral Bustier Dress
            [
                'id_product' => 2,
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 350000,
                'stock' => 5,
                'status' => 'Ready',
            ],
            [
                'id_product' => 2,
                'color' => 'White Floral',
                'size' => 'L',
                'price' => 350000,
                'stock' => 8,
                'status' => 'Ready',
            ],

            // 3. Off-Shoulder Knit Top
            [
                'id_product' => 3,
                'color' => 'White',
                'size' => 'M',
                'price' => 145000,
                'stock' => 12,
                'status' => 'Ready',
            ],
            [
                'id_product' => 3,
                'color' => 'White',
                'size' => 'L',
                'price' => 145000,
                'stock' => 14,
                'status' => 'Ready',
            ],

            // 4. Ruched Milkmaid Top
            [
                'id_product' => 4,
                'color' => 'White',
                'size' => 'M',
                'price' => 135000,
                'stock' => 20,
                'status' => 'Ready',
            ],

            // 5. Asymmetrical Floral Cami
            [
                'id_product' => 5,
                'color' => 'Pink-Lilac',
                'size' => 'M',
                'price' => 115000,
                'stock' => 10,
                'status' => 'Ready',
            ],

            // 6. Lilac Floral Corset Top
            [
                'id_product' => 6,
                'color' => 'Lilac',
                'size' => 'M',
                'price' => 165000,
                'stock' => 7,
                'status' => 'Ready',
            ],

            // 7. Daisy Pattern A-Line Skirt
            [
                'id_product' => 7,
                'color' => 'Yellow-Lilac',
                'size' => 'S',
                'price' => 150000,
                'stock' => 12,
                'status' => 'Ready',
            ],
            [
                'id_product' => 7,
                'color' => 'Yellow-Lilac',
                'size' => 'M',
                'price' => 150000,
                'stock' => 15,
                'status' => 'Ready',
            ],

            // 8. Plaid Halter Corset Top
            [
                'id_product' => 8,
                'color' => 'Blue-Yellow Plaid',
                'size' => 'M',
                'price' => 140000,
                'stock' => 9,
                'status' => 'Ready',
            ],

            // 9. Lace Trim Ruffle Blouse
            [
                'id_product' => 9,
                'color' => 'White',
                'size' => 'M',
                'price' => 155000,
                'stock' => 11,
                'status' => 'Ready',
            ],

            // 10. Plaid Gingham Camisole
            [
                'id_product' => 10,
                'color' => 'Black-White',
                'size' => 'M',
                'price' => 110000,
                'stock' => 18,
                'status' => 'Ready',
            ],

            // 11. Yellow Floral Lace-Up Top
            [
                'id_product' => 11,
                'color' => 'Yellow Floral',
                'size' => 'M',
                'price' => 170000,
                'stock' => 8,
                'status' => 'Ready',
            ],

            // 12. Polkadot Ribbon Tie Top
            [
                'id_product' => 12,
                'color' => 'White Polkadot',
                'size' => 'M',
                'price' => 130000,
                'stock' => 13,
                'status' => 'Ready',
            ],

            // 13. Gingham Plaid Bustier
            [
                'id_product' => 13,
                'color' => 'Light Blue',
                'size' => 'M',
                'price' => 160000,
                'stock' => 10,
                'status' => 'Ready',
            ],

            // 14. Cream Wide-Leg Trousers
            [
                'id_product' => 14,
                'color' => 'Cream',
                'size' => 'M',
                'price' => 240000,
                'stock' => 14,
                'status' => 'Ready',
            ],
            [
                'id_product' => 14,
                'color' => 'Cream',
                'size' => 'L',
                'price' => 240000,
                'stock' => 9,
                'status' => 'Ready',
            ],

            // 15. Vintage Floral Maxi Skirt
            [
                'id_product' => 15,
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 210000,
                'stock' => 11,
                'status' => 'Ready',
            ],

            // 16. Floral Mini Skort with Ties
            [
                'id_product' => 16,
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 175000,
                'stock' => 16,
                'status' => 'Ready',
            ],

            // 17. Denim Pleated Mini Skirt
            [
                'id_product' => 17,
                'color' => 'Light Blue',
                'size' => 'S',
                'price' => 195000,
                'stock' => 10,
                'status' => 'Ready',
            ],
            [
                'id_product' => 17,
                'color' => 'Light Blue',
                'size' => 'M',
                'price' => 195000,
                'stock' => 12,
                'status' => 'Ready',
            ],

            // 18. Red Gingham Pleated Skirt
            [
                'id_product' => 18,
                'color' => 'Red-White',
                'size' => 'M',
                'price' => 165000,
                'stock' => 20,
                'status' => 'Ready',
            ],

            // 19. Two-Tone Plaid Mini Skirt
            [
                'id_product' => 19,
                'color' => 'Dark Plaid-Khaki',
                'size' => 'M',
                'price' => 185000,
                'stock' => 8,
                'status' => 'Ready',
            ],

            // 20. Y2K Pleated Low-Rise Skirt
            [
                'id_product' => 20,
                'color' => 'Brown',
                'size' => 'M',
                'price' => 190000,
                'stock' => 7,
                'status' => 'Ready',
            ],

            // 21. High-Waist Wide Jeans
            [
                'id_product' => 21,
                'color' => 'Light Blue Wash',
                'size' => 'M', // Disesuaikan dengan pilihan ENUM
                'price' => 280000,
                'stock' => 15,
                'status' => 'Ready',
            ],
            [
                'id_product' => 21,
                'color' => 'Light Blue Wash',
                'size' => 'L', // Disesuaikan dengan pilihan ENUM
                'price' => 280000,
                'stock' => 11,
                'status' => 'Ready',
            ],

            // 22. Dark Blue Denim Shorts
            [
                'id_product' => 22,
                'color' => 'Navy Blue',
                'size' => 'M',
                'price' => 150000,
                'stock' => 25,
                'status' => 'Ready',
            ],

            // 23. Acid Wash Denim Bermuda
            [
                'id_product' => 23,
                'color' => 'Acid Wash Yellow',
                'size' => 'M',
                'price' => 175000,
                'stock' => 13,
                'status' => 'Ready',
            ],
            
            // 24. Classic Slim-Fit Black Shirt
            [
                'id_product' => 24,
                'color' => 'Black',
                'size' => 'L',
                'price' => 225000,
                'stock' => 18,
                'status' => 'Ready',
            ],
            [
                'id_product' => 24,
                'color' => 'Black',
                'size' => 'XL',
                'price' => 225000,
                'stock' => 7,
                'status' => 'Ready',
            ],

            // 25. Smart Casual Shirt & Sweater
            [
                'id_product' => 25,
                'color' => 'Light Blue-Brown',
                'size' => 'L',
                'price' => 299000,
                'stock' => 6,
                'status' => 'Ready',
            ],

            // 26. Layered Black Open Shirt
            [
                'id_product' => 26,
                'color' => 'Black-White',
                'size' => 'L',
                'price' => 245000,
                'stock' => 12,
                'status' => 'Ready',
            ],

            // 27. Olive Green Cuban Shirt
            [
                'id_product' => 27,
                'color' => 'Olive Green',
                'size' => 'M',
                'price' => 195000,
                'stock' => 22,
                'status' => 'Ready',
            ],
            [
                'id_product' => 27,
                'color' => 'Olive Green',
                'size' => 'L',
                'price' => 195000,
                'stock' => 15,
                'status' => 'Ready',
            ],

            // 28. Flannel Plaid Oversized Shirt
            [
                'id_product' => 28,
                'color' => 'Brown-Black Plaid',
                'size' => 'XL',
                'price' => 260000,
                'stock' => 10,
                'status' => 'Ready',
            ],
            
            // 29. Monogram Tailored Shorts
            [
                'id_product' => 29,
                'color' => 'Monogram Brown',
                'size' => 'M',
                'price' => 210000,
                'stock' => 8,
                'status' => 'Ready',
            ],

            // 30. Army Green Multi-Pocket Cargo
            [
                'id_product' => 30,
                'color' => 'Army Green',
                'size' => 'L',
                'price' => 320000,
                'stock' => 14,
                'status' => 'Ready',
            ],
            [
                'id_product' => 30,
                'color' => 'Army Green',
                'size' => 'XL',
                'price' => 320000,
                'stock' => 9,
                'status' => 'Ready',
            ],

            // 31. Ripped Black Denim Shorts
            [
                'id_product' => 31,
                'color' => 'Ripped Black',
                'size' => 'L',
                'price' => 180000,
                'stock' => 11,
                'status' => 'Ready',
            ],

            // 32. Classic 3-Stripes Trackpants
            [
                'id_product' => 32,
                'color' => 'Black-White',
                'size' => 'L',
                'price' => 275000,
                'stock' => 20,
                'status' => 'Ready',
            ],
        ];

        foreach ($variants as $variant) {

            DB::table('product_variants')
                ->updateOrInsert(

                    [
                        'id_product' => $variant['id_product'],
                        'color' => $variant['color'],
                        'size' => $variant['size'],
                    ],

                    [
                        'price' => $variant['price'],

                        'stock' => $variant['stock'],

                        'status' => $variant['status'],

                        'updated_at' => now(),
                    ]

                );
        }
    }
}