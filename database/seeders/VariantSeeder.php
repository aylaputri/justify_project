<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class VariantSeeder extends Seeder
{
    public function run(): void
    {
        $variants = [
            [
                'product_name' => 'Ribbed Ribbon Crop Top',        
                'color' => 'White',              
                'size' => 'M', 
                'price' => 125000, 
                'stock' => 15, 
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Ribbed Ribbon Crop Top',
                'color' => 'White',
                'size' => 'L',
                'price' => 125000,
                'stock' => 10,
                'status' => 'Ready'
            ],
            [
                'product_name' => '3D Floral Bustier Dress',
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 350000,
                'stock' => 5,
                'status' => 'Ready'
            ],
            [
                'product_name' => '3D Floral Bustier Dress',
                'color' => 'White Floral',
                'size' => 'L',
                'price' => 350000,
                'stock' => 8,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Off-Shoulder Knit Top',
                'color' => 'White',
                'size' => 'M',
                'price' => 145000,
                'stock' => 12,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Off-Shoulder Knit Top',
                'color' => 'White',
                'size' => 'L',
                'price' => 145000,
                'stock' => 14,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Ruched Milkmaid Top',
                'color' => 'White',
                'size' => 'M',
                'price' => 135000,
                'stock' => 20,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Asymmetrical Floral Cami',
                'color' => 'Pink-Lilac',
                'size' => 'M',
                'price' => 115000,
                'stock' => 10,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Lilac Floral Corset Top',
                'color' => 'Lilac',
                'size' => 'M',
                'price' => 165000,
                'stock' => 7,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Daisy Pattern A-Line Skirt',
                'color' => 'Yellow-Lilac',
                'size' => 'S',
                'price' => 150000,
                'stock' => 12,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Daisy Pattern A-Line Skirt',
                'color' => 'Yellow-Lilac',
                'size' => 'M',
                'price' => 150000,
                'stock' => 15,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Plaid Halter Corset Top',
                'color' => 'Blue-Yellow Plaid',
                'size' => 'M',
                'price' => 140000,
                'stock' => 9,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Lace Trim Ruffle Blouse',
                'color' => 'White',
                'size' => 'M',
                'price' => 155000,
                'stock' => 11,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Plaid Gingham Camisole',
                'color' => 'Black-White',
                'size' => 'M',
                'price' => 110000,
                'stock' => 18,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Yellow Floral Lace-Up Top',
                'color' => 'Yellow Floral',
                'size' => 'M',
                'price' => 170000,
                'stock' => 8,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Polkadot Ribbon Tie Top',
                'color' => 'White Polkadot',
                'size' => 'M',
                'price' => 130000,
                'stock' => 13,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Gingham Plaid Bustier',
                'color' => 'Light Blue',
                'size' => 'M',
                'price' => 160000,
                'stock' => 10,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Vintage Floral Maxi Skirt',
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 210000,
                'stock' => 11,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Floral Mini Skort with Ties',
                'color' => 'White Floral',
                'size' => 'M',
                'price' => 175000,
                'stock' => 16,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Denim Pleated Mini Skirt',
                'color' => 'Light Blue',
                'size' => 'S',
                'price' => 195000,
                'stock' => 10,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Denim Pleated Mini Skirt',
                'color' => 'Light Blue',
                'size' => 'M',
                'price' => 195000,
                'stock' => 12,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Red Gingham Pleated Skirt',
                'color' => 'Red-White',
                'size' => 'M',
                'price' => 165000,
                'stock' => 20,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Two-Tone Plaid Mini Skirt',
                'color' => 'Dark Plaid-Khaki',
                'size' => 'M',
                'price' => 185000,
                'stock' => 8,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Y2K Pleated Low-Rise Skirt',
                'color' => 'Brown',
                'size' => 'M',
                'price' => 190000,
                'stock' => 7,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'High-Waist Wide Jeans',
                'color' => 'Light Blue Wash',
                'size' => 'M',
                'price' => 280000,
                'stock' => 15,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'High-Waist Wide Jeans',
                'color' => 'Light Blue Wash',
                'size' => 'L',
                'price' => 280000,
                'stock' => 11,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Dark Blue Denim Shorts',
                'color' => 'Navy Blue',
                'size' => 'M',
                'price' => 150000,
                'stock' => 25,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Acid Wash Denim Bermuda',
                'color' => 'Acid Wash Yellow',
                'size' => 'M',
                'price' => 175000,
                'stock' => 13,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Classic Slim-Fit Black Shirt',
                'color' => 'Black',
                'size' => 'L',
                'price' => 225000,
                'stock' => 18,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Classic Slim-Fit Black Shirt',
                'color' => 'Black',
                'size' => 'XL',
                'price' => 225000,
                'stock' => 7,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Smart Casual Shirt & Sweater',
                'color' => 'Light Blue-Brown',
                'size' => 'L',
                'price' => 299000,
                'stock' => 6,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Layered Black Open Shirt',
                'color' => 'Black-White',
                'size' => 'L',
                'price' => 245000,
                'stock' => 12,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Olive Green Cuban Shirt',
                'color' => 'Olive Green',
                'size' => 'M',
                'price' => 195000,
                'stock' => 22,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Olive Green Cuban Shirt',
                'color' => 'Olive Green',
                'size' => 'L',
                'price' => 195000,
                'stock' => 15,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Flannel Plaid Oversized Shirt',
                'color' => 'Brown-Black Plaid',
                'size' => 'XL',
                'price' => 260000,
                'stock' => 10,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Monogram Tailored Shorts',
                'color' => 'Monogram Brown',
                'size' => 'M',
                'price' => 210000,
                'stock' => 8,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Army Green Multi-Pocket Cargo',
                'color' => 'Army Green',
                'size' => 'L',
                'price' => 320000,
                'stock' => 14,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Army Green Multi-Pocket Cargo',
                'color' => 'Army Green',
                'size' => 'XL',
                'price' => 320000,
                'stock' => 9,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Ripped Black Denim Shorts',
                'color' => 'Ripped Black',
                'size' => 'L',
                'price' => 180000,
                'stock' => 11,
                'status' => 'Ready'
            ],
            [
                'product_name' => 'Classic 3-Stripes Trackpants',
                'color' => 'Black-White',
                'size' => 'L',
                'price' => 275000,
                'stock' => 20,
                'status' => 'Ready'
            ],
        ];

        foreach ($variants as $variant) {
            $product = Product::where('product_name', $variant['product_name'])->first();
            if (!$product) continue;

            DB::table('product_variants')->updateOrInsert(
                [
                    'id_product' => $product->id_product,
                    'color'      => $variant['color'],
                    'size'       => $variant['size'],
                ],
                [
                    'price'      => $variant['price'],
                    'stock'      => $variant['stock'],
                    'status'     => $variant['status'],
                    'updated_at' => now(),
                ]
            );
        }
    }
}