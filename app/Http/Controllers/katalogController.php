<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with([
            'category',
            'variants.images'
        ]);

        // FILTER KATEGORI
        if ($request->kategori) {

            $products->whereHas('category', function ($query) use ($request) {

                $query->where(
                    'category_name',
                    $request->kategori
                );
            });
        }

        // FILTER SIZE
        if ($request->size) {

            $products->whereHas('variants', function ($query) use ($request) {

                $query->where('size', $request->size);
            });
        }

        // FILTER COLOR
        if ($request->colors) {

            $products->whereHas('variants', function ($query) use ($request) {

                $query->where('color', $request->colors);
            });
        }

        // SORTING
        if ($request->sorting == 'hargaTertinggi') {

            $products->withMin('variants', 'price')
                ->orderByDesc('variants_min_price');

        } elseif ($request->sorting == 'hargaTerendah') {

            $products->withMin('variants', 'price')
                ->orderBy('variants_min_price');
        }

        return view('page.katalog', [
            'products' => $products->get()
        ]);
    }
}