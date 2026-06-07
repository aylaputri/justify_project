<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategories;
use App\Models\SizeChart;
use Illuminate\Http\Request;

class ManageCatalogController extends Controller
{
    public function index()
    {
        $products   = Product::with(['category', 'variants.images'])->get();
        $categories = ProductCategories::all();
        return view('admin.manageCatalog', compact('products', 'categories'));
    }

    public function getSizeChart($id_category)
    {
        $charts = SizeChart::where('id_category', $id_category)
            ->orderBy('size')
            ->get(['size', 'length_cm', 'width_cm']);
        return response()->json($charts);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name',
        ], [
            'product_name.required' => 'Nama produk wajib diisi.',
            'product_name.unique'   => 'Nama produk sudah digunakan, gunakan nama lain.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke storage/app/public/products, hasilnya "products/filename.jpg"
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'id_category'  => $request->id_category,
            'description'  => $request->description,
        ]);

        $sizes  = $request->input('sizes', []);
        $colors = json_decode($request->colors ?? '[]', true);

        $sizesToUse  = !empty($sizes)  ? $sizes  : ['M'];
        $colorsToUse = !empty($colors) ? $colors : ['-'];

        foreach ($sizesToUse as $size) {
            foreach ($colorsToUse as $color) {
                $variant = $product->variants()->create([
                    'size'   => $size,
                    'color'  => $color,
                    'price'  => $request->price  ?? 0,
                    'stock'  => $request->stock  ?? 0,
                    'status' => $request->status ?? 'Ready',
                ]);

                if ($imagePath) {
                    $variant->images()->create([
                        'image_url' => $imagePath, // simpan tanpa prefix "storage/"
                        'is_main'   => 1,
                    ]);
                }
            }
        }

        return redirect('/admin/manage-catalog')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|unique:products,product_name,' . $id . ',id_product',
        ], [
            'product_name.required' => 'Nama produk wajib diisi.',
            'product_name.unique'   => 'Nama produk sudah digunakan, gunakan nama lain.',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'product_name' => $request->product_name,
            'id_category'  => $request->id_category,
            'description'  => $request->description,
        ]);

        $variant = $product->variants()->first();
        if ($variant) {
            $variant->update([
                'price'  => $request->price  ?? $variant->price,
                'stock'  => $request->stock  ?? $variant->stock,
                'status' => $request->status ?? $variant->status,
            ]);

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');
                $image     = $variant->images()->first();

                if ($image) {
                    $image->update([
                        'image_url' => $imagePath, // simpan tanpa prefix "storage/"
                        'is_main'   => 1,
                    ]);
                } else {
                    $variant->images()->create([
                        'image_url' => $imagePath, // simpan tanpa prefix "storage/"
                        'is_main'   => 1,
                    ]);
                }
            }
        }

        return redirect('/admin/manage-catalog')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/admin/manage-catalog')->with('success', 'Produk berhasil dihapus');
    }
}