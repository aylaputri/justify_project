<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with([
            'category.sizeCharts',
            'variants.images',
        ]);

        if ($request->kategori) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_name', $request->kategori);
            });
        }

        if ($request->size) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('size', $request->size);
            });
        }

        if ($request->colors) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->where('color', $request->colors);
            });
        }

        if ($request->sorting == 'hargaTertinggi') {
            $query->withMin('variants', 'price')->orderByDesc('variants_min_price');
        } elseif ($request->sorting == 'hargaTerendah') {
            $query->withMin('variants', 'price')->orderBy('variants_min_price');
        }

        $products = $query->get()->map(function ($product) {
            $product->variantMap = $product->variants->map(function ($v) {
                return [
                    'id'    => $v->id_variant,
                    'size'  => $v->size,
                    'color' => $v->color,
                    'stock' => $v->stock,
                ];
            })->values()->toArray();
            return $product;
        });

        return view('page.katalog', compact('products'));
    }
}