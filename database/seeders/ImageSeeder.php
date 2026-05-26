<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImageSeeder extends Seeder
{
    public function run(): void
    {

        $images = [
            [
                'id_variant' => 1, // Ribbed Ribbon Crop Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe1.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 3, // 3D Floral Bustier Dress
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe2.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 5, // Off-Shoulder Knit Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe3.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 7, // Ruched Milkmaid Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe4.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 8, // Asymmetrical Floral Cami
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe5.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 9, // Lilac Floral Corset Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe6.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 10, // Daisy Pattern A-Line Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe7.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 12, // Plaid Halter Corset Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe8.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 13, // Lace Trim Ruffle Blouse
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe9.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 14, // Plaid Gingham Camisole
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe10.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 15, // Yellow Floral Lace-Up Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe11.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 16, // Polkadot Ribbon Tie Top
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe12.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 17, // Gingham Plaid Bustier
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe13.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 18, // Cream Wide-Leg Trousers
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe1.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 20, // Vintage Floral Maxi Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe2.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 21, // Floral Mini Skort with Ties
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe3.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 22, // Denim Pleated Mini Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe4.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 24, // Red Gingham Pleated Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe5.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 25, // Two-Tone Plaid Mini Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe6.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 26, // Y2K Pleated Low-Rise Skirt
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe7.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 27, // High-Waist Wide Jeans
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe8.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 29, // Dark Blue Denim Shorts
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe9.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 30, // Acid Wash Denim Bermuda
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe10.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 31, // Classic Slim-Fit Black Shirt
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo1.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 33, // Smart Casual Shirt & Sweater
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo2.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 34, // Layered Black Open Shirt
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo3.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 35, // Olive Green Cuban Shirt
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo4.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 37, // Flannel Plaid Oversized Shirt
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo5.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 38, // Monogram Tailored Shorts
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo1.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 39, // Army Green Multi-Pocket Cargo
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo2.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 41, // Ripped Black Denim Shorts
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo3.png',
                'is_main' => 1,
            ],
            [
                'id_variant' => 42, // Classic 3-Stripes Trackpants
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo4.png',
                'is_main' => 1,
            ],
        ];

        foreach ($images as $image) {

            DB::table('product_images')
                ->updateOrInsert(

                    [
                        'id_variant' => $image['id_variant'],
                        'image_url' => $image['image_url'],
                    ],

                    [
                        'is_main' => $image['is_main'],
                    ]

                );
        }

    }

}