<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            [
                'product_name' => 'Ribbed Ribbon Crop Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe1.png'
            ],
            [
                'product_name' => '3D Floral Bustier Dress',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe2.png'
            ],
            [
                'product_name' => 'Off-Shoulder Knit Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe3.png'
            ],
            [
                'product_name' => 'Ruched Milkmaid Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe4.png'
            ],
            [
                'product_name' => 'Asymmetrical Floral Cami',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe5.png'
            ],
            [
                'product_name' => 'Lilac Floral Corset Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe6.png'
            ],
            [
                'product_name' => 'Daisy Pattern A-Line Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe7.png'
            ],
            [
                'product_name' => 'Plaid Halter Corset Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe8.png'
            ],
            [
                'product_name' => 'Lace Trim Ruffle Blouse',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe9.png'
            ],
            [
                'product_name' => 'Plaid Gingham Camisole',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe10.png'
            ],
            [
                'product_name' => 'Yellow Floral Lace-Up Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe11.png'
            ],
            [
                'product_name' => 'Polkadot Ribbon Tie Top',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe12.png'
            ],
            [
                'product_name' => 'Gingham Plaid Bustier',
                'image_url' => 'assets/image/imgMixmatch/wanita/atscewe13.png'
            ],
            [
                'product_name' => 'Vintage Floral Maxi Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe2.png'
            ],
            [
                'product_name' => 'Floral Mini Skort with Ties',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe3.png'
            ],
            [
                'product_name' => 'Denim Pleated Mini Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe4.png'
            ],
            [
                'product_name' => 'Red Gingham Pleated Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe5.png'
            ],
            [
                'product_name' => 'Two-Tone Plaid Mini Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe6.png'
            ],
            [
                'product_name' => 'Y2K Pleated Low-Rise Skirt',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe7.png'
            ],
            [
                'product_name' => 'High-Waist Wide Jeans',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe8.png'
            ],
            [
                'product_name' => 'Dark Blue Denim Shorts',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe9.png'
            ],
            [
                'product_name' => 'Acid Wash Denim Bermuda',
                'image_url' => 'assets/image/imgMixmatch/wanita/bwhcewe10.png'
            ],
            [
                'product_name' => 'Classic Slim-Fit Black Shirt',
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo1.png'
            ],
            [
                'product_name' => 'Smart Casual Shirt & Sweater',
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo2.png'
            ],
            [
                'product_name' => 'Layered Black Open Shirt',
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo3.png'
            ],
            [
                'product_name' => 'Olive Green Cuban Shirt',
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo4.png'
            ],
            [
                'product_name' => 'Flannel Plaid Oversized Shirt',
                'image_url' => 'assets/image/imgMixmatch/pria/atscowo5.png'
            ],
            [
                'product_name' => 'Monogram Tailored Shorts',
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo1.png'
            ],
            [
                'product_name' => 'Army Green Multi-Pocket Cargo',
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo2.png'
            ],
            [
                'product_name' => 'Ripped Black Denim Shorts',
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo3.png'
            ],
            [
                'product_name' => 'Classic 3-Stripes Trackpants',
                'image_url' => 'assets/image/imgMixmatch/pria/bwhcowo4.png'
            ],
        ];

        foreach ($images as $image) {
            $product = Product::where('product_name', $image['product_name'])->first();
            if (!$product) continue;

            $variant = $product->variants()->first();
            if (!$variant) continue;

            $exists = DB::table('product_images')
                ->where('id_variant', $variant->id_variant)
                ->where('image_url', $image['image_url'])
                ->exists();

            if (!$exists) {
                DB::table('product_images')->insert([
                    'id_variant' => $variant->id_variant,
                    'image_url'  => $image['image_url'],
                    'is_main'    => 1,
                ]);
            } else {
                DB::table('product_images')
                    ->where('id_variant', $variant->id_variant)
                    ->where('image_url', $image['image_url'])
                    ->update(['is_main' => 1]);
            }
        }
    }
}