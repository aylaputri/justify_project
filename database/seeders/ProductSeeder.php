<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {

        $products = [
            [
                'id_category' => 2, // Crop top
                'product_name' => "Ribbed Ribbon Crop Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan lengan pendek putih dengan detail ikat tali merah di bagian dada.',
            ],
            [
                'id_category' => 1, // Dress
                'product_name' => "3D Floral Bustier Dress",
                'gender' => 'Perempuan',
                'description' => 'Dress mini putih dengan aksen bunga 3D warna-warni dan tali pundak tipis.',
            ],
            [
                'id_category' => 3, // Off-Shoulder
                'product_name' => "Off-Shoulder Knit Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan rajut putih model sabrina dengan detail kancing depan dan pita kecil.',
            ],
            [
                'id_category' => 4, // Blousse
                'product_name' => "Ruched Milkmaid Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan putih dengan kerutan di dada dan lengan puff pendek ala cottagecore.',
            ],
            [
                'id_category' => 5, // Tanktop
                'product_name' => "Asymmetrical Floral Cami",
                'gender' => 'Perempuan',
                'description' => 'Atasan tali tipis motif bunga pink-lilac dengan potongan bawah asimetris.',
            ],
            [
                'id_category' => 6, // Corset
                'product_name' => "Lilac Floral Corset Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan korset tanpa lengan berwarna pastel dengan motif bunga lilac lembut.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Daisy Pattern A-Line Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok mini bersiluet A-line dengan motif bunga daisy kuning-lilac kecil.',
            ],
            [
                'id_category' => 5, // Tanktop (Halter)
                'product_name' => "Plaid Halter Corset Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan halterneck motif kotak-kotak kuning-biru dengan detail kancing depan.',
            ],
            [
                'id_category' => 4, // Blousse
                'product_name' => "Lace Trim Ruffle Blouse",
                'gender' => 'Perempuan',
                'description' => 'Atasan putih bertekstur dengan detail kerutan (ruffles) dan tepian renda.',
            ],
            [
                'id_category' => 5, // Tanktop (Camisole)
                'product_name' => "Plaid Gingham Camisole",
                'gender' => 'Perempuan',
                'description' => 'Atasan longgar (flowy) motif kotak-kotak hitam putih dengan tali hitam.',
            ],
            [
                'id_category' => 6, // Corset
                'product_name' => "Yellow Floral Lace-Up Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan bustier motif bunga kuning dengan detail tali sepatu (lace-up) di depan.',
            ],
            [
                'id_category' => 4, // Blousse
                'product_name' => "Polkadot Ribbon Tie Top",
                'gender' => 'Perempuan',
                'description' => 'Atasan putih motif polkadot hitam dengan aksen pita biru tua di bawah dada.',
            ],
            [
                'id_category' => 6, // Corset
                'product_name' => "Gingham Plaid Bustier",
                'gender' => 'Perempuan',
                'description' => 'Atasan bustier seksi motif kotak-kotak biru muda (gingham) dengan detail pita.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Cream Wide-Leg Trousers",
                'gender' => 'Perempuan',
                'description' => 'Celana panjang kain berwarna krem dengan potongan lurus dan longgar.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Vintage Floral Maxi Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok panjang (maxi) berwarna putih dengan motif bunga-bunga vintage yang estetik.',
            ],
            [
                'id_category' => 11, // Skort
                'product_name' => "Floral Mini Skort with Ties",
                'gender' => 'Perempuan',
                'description' => 'Rok mini motif bunga kecil yang dilengkapi tali samping, praktis karena berbentuk skort.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Denim Pleated Mini Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok mini jeans lipit-lipit (pleated) warna biru muda dengan detail renda putih.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Red Gingham Pleated Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok mini lipit motif kotak-kotak merah putih ala sekolah dengan tepian renda.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Two-Tone Plaid Mini Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok mini paduan motif kotak-kotak gelap dan kain polos krem dengan detail bordir bintang.',
            ],
            [
                'id_category' => 10, // Skirt
                'product_name' => "Y2K Pleated Low-Rise Skirt",
                'gender' => 'Perempuan',
                'description' => 'Rok mini lipit gaya Y2K warna cokelat dengan aksen ban pinggang ganda.',
            ],
            [
                'id_category' => 9, // Jeans
                'product_name' => "High-Waist Wide Jeans",
                'gender' => 'Perempuan',
                'description' => 'Celana jeans panjang high-waist berwarna light blue wash dengan potongan lebar.',
            ],
            [
                'id_category' => 12, // Shorts
                'product_name' => "Dark Blue Denim Shorts",
                'gender' => 'Perempuan',
                'description' => 'Celana pendek jeans warna biru tua (navy) pekat dilengkapi dengan ikat pinggang.',
            ],
            [
                'id_category' => 12, // Shorts
                'product_name' => "Acid Wash Denim Bermuda",
                'gender' => 'Perempuan',
                'description' => 'Celana pendek jeans model loose/Bermuda dengan efek washed kekuningan.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Classic Slim-Fit Black Shirt",
                'gender' => 'Laki-laki',
                'description' => 'Kemeja lengan panjang polos warna hitam pekat dengan potongan pas badan.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Smart Casual Shirt & Sweater",
                'gender' => 'Laki-laki',
                'description' => 'Kemeja biru muda polos yang dipadukan dengan sweater cokelat melingkar di bahu.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Layered Black Open Shirt",
                'gender' => 'Laki-laki',
                'description' => 'Kemeja lengan panjang hitam yang dipakai terbuka sebagai luaran kaos putih.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Olive Green Cuban Shirt",
                'gender' => 'Laki-laki',
                'description' => 'Kemeja lengan pendek warna hijau oliv polos dengan kerah model Cuban.',
            ],
            [
                'id_category' => 8, // Shirt
                'product_name' => "Flannel Plaid Oversized Shirt",
                'gender' => 'Laki-laki',
                'description' => 'Kemeja flanel motif kotak-kotak cokelat-hitam yang dipadukan dengan kaos putih.',
            ],
            [
                'id_category' => 12, // Shorts
                'product_name' => "Monogram Tailored Shorts",
                'gender' => 'Laki-laki',
                'description' => 'Celana pendek kain formal cokelat dengan motif monogram penuh yang elegan.',
            ],
            [
                'id_category' => 13, // Cargo
                'product_name' => "Army Green Multi-Pocket Cargo",
                'gender' => 'Laki-laki',
                'description' => 'Celana panjang kargo warna hijau tentara/olif dengan banyak kantong fungsional.',
            ],
            [
                'id_category' => 14, // Ripped jeans
                'product_name' => "Ripped Black Denim Shorts",
                'gender' => 'Laki-laki',
                'description' => 'Celana pendek jeans hitam dengan detail robek-robek (ripped) dan rumbai di bawah.',
            ],
            [
                'id_category' => 12, // Shorts
                'product_name' => "Classic 3-Stripes Trackpants",
                'gender' => 'Laki-laki',
                'description' => 'Celana panjang olahraga (sportswear) warna hitam dengan detail 3 garis putih di samping.',
            ],
        ];

        foreach ($products as $product) {

            Product::updateOrCreate(

                [
                    'product_name' => $product['product_name']
                ],

                [
                    'id_category' => $product['id_category'],

                    'gender' => $product['gender'],

                    'description' => $product['description'],
                ]

            );

        }

    }
}