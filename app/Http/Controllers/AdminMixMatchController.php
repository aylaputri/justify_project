<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminMixMatchController extends Controller
{
    public function index()
{
    // 1. Tarik semua produk dari database katalog utama
    $products = DB::table('products')
        ->latest('created_at')
        ->get();

    // 2. Loop setiap produk untuk dicarikan gambarnya lewat jalur varian
    foreach ($products as $prod) {
        
        // Cari id_variant pertama yang dimiliki oleh id_product ini di tabel product_variants
        $variant = DB::table('product_variants')
            ->where('id_product', $prod->id_product)
            ->first();

        $imageRow = null;

        // Jika varian ditemukan, cari gambar utamanya di tabel product_images menggunakan id_variant
        if ($variant) {
            $imageRow = DB::table('product_images')
                ->where('id_variant', $variant->id_variant)
                ->where('is_main', 1)
                ->first();

            // Jika gambar utama (is_main = 1) tidak ada, ambil gambar apa saja yang penting id_variant-nya cocok
            if (!$imageRow) {
                $imageRow = DB::table('product_images')
                    ->where('id_variant', $variant->id_variant)
                    ->first();
            }
        }

        // 3. Set hasil gambar ke dalam objek produk agar bisa dibaca oleh Blade
        if ($imageRow) {
            $prod->image_url = $imageRow->image_url;
        } else {
            // Gambar default kalau produk/varian tersebut belum dipasang fotonya di database
            $prod->image_url = 'assets/image/imgMixmatch/default.png';
        }
    }

    return view('admin.manageMixmatch', compact('products'));
}


    // 2. Tampilkan Form Tambah Produk (diarahkan ke index karena pakai modal)
    public function create()
    {
        return view('admin.createMixmatch');
    }

    // 3. Proses Simpan Produk Baru Langsung ke DB Katalog Utama
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'id_category' => 'required|integer',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'image' => 'required|image|mimes:png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/image/imgMixmatch/uploaded'), $filename);
            // NB: Jika di tabel products kamu tidak ada kolom 'image', sesuaikan nama kolom gambar jualanmu di sini!
            $imagePath = 'assets/image/imgMixmatch/uploaded/' . $filename; 
        }

        Product::create([
            'product_name' => $request->product_name,
            'id_category' => $request->id_category,
            'gender' => $request->gender,
            'image' => $imagePath, // Sesuaikan dengan kolom gambar jualanmu jika namanya beda
            'description' => $request->description ?? '-',
        ]);

        return redirect()->route('admin.manageMixmatch.index')->with('success', 'Bung, Produk baru berhasil ditambahkan!');
    }

    // 4. Tampilkan Halaman Form Edit (Terpisah)
public function edit($id)
{
    // Ambil data produk berdasarkan id_product
    $product = DB::table('products')->where('id_product', $id)->first();

    if (!$product) {
        return redirect()->route('admin.manageMixmatch.index')->with('error', 'Produk tidak ditemukan, Bung!');
    }

    // Cari tahu gambar lamanya dari tabel varian & images untuk dipajang sebagai pratinjau
    $variant = DB::table('product_variants')->where('id_product', $id)->first();
    $imagePath = 'assets/image/imgMixmatch/default.png'; // default jika tidak ada

    if ($variant) {
        $imageRow = DB::table('product_images')->where('id_variant', $variant->id_variant)->where('is_main', 1)->first();
        if ($imageRow) {
            $imagePath = $imageRow->image_url;
        }
    }

    // Tempelkan path gambar ke objek produk agar gampang dipanggil di Blade
    $product->image_url = $imagePath;

    // Return ke file edit terpisah: resources/views/admin/editMixmatch.blade.php
    return view('admin.edit_Mixmatch', compact('product'));
}

// 5. Proses Update Data dari Halaman Edit Terpisah
public function update(Request $request, $id)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'id_category'  => 'required|integer',
        'gender'       => 'required|in:Laki-laki,Perempuan',
        'image'        => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Gambar opsional saat edit
    ]);

    // Update data di tabel products
    DB::table('products')->where('id_product', $id)->update([
        'product_name' => $request->product_name,
        'id_category'  => $request->id_category,
        'gender'       => $request->gender,
        'updated_at'   => now(),
    ]);

    // Jika admin mengunggah gambar baru
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('assets/image/imgMixmatch/uploaded'), $filename);
        $newImagePath = 'assets/image/imgMixmatch/uploaded/' . $filename;

        // Cari variannya
        $variant = DB::table('product_variants')->where('id_product', $id)->first();
        
        if ($variant) {
            // Cek apakah sudah ada baris gambarnya di tabel product_images
            $imageExists = DB::table('product_images')->where('id_variant', $variant->id_variant)->first();

            if ($imageExists) {
                // Hapus fisik file lama dari storage local (biar tidak penuh-penuhin server)
                $oldPath = public_path($imageExists->image_url);
                if (file_exists($oldPath) && !str_contains($imageExists->image_url, 'default')) {
                    @unlink($oldPath);
                }

                // Update path gambar baru di database
                DB::table('product_images')->where('id_variant', $variant->id_variant)->update([
                    'image_url'  => $newImagePath,
                    'updated_at' => now(),
                ]);
            } else {
                // Jika ternyata varian ada tapi datanya belum punya gambar sama sekali di DB, buat baru
                DB::table('product_images')->insert([
                    'id_variant' => $variant->id_variant,
                    'image_url'  => $newImagePath,
                    'is_main'    => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    return redirect()->route('admin.manageMixmatch.index')->with('success', 'Bung, data pakaian berhasil diperbarui dari halaman terpisah!');
}

    // 6. Proses Hapus Data
    public function destroy($id)
    {
        $product = Product::where('id_product', $id)->firstOrFail();
        $product->delete();
        
        return redirect()->route('admin.manageMixmatch.index')->with('success', 'Produk berhasil dihapus!');
    }
}