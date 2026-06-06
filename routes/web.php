<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManageCatalogController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;

Route::get('/admin/login', [AuthController::class, 'showLogin']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::middleware('admin')->group(function () {

    // DASHBOARD
    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'index']
    );

    Route::get('/admin/profile', fn() => view('admin.profile'));

   Route::get('/admin/customers', [CustomerController::class, 'index'])->name('customers.index');

    Route::get('/admin/staffs', [StaffController::class, 'index'])->name('staffs.index');
    
    // 2. Menambahkan rute untuk menampilkan Form Edit Staf (Menuju ke admin.edit)
    Route::get('/admin/staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
    
    // 3. Menambahkan rute untuk memproses Simpan Perubahan Data Staf (Method PUT)
    Route::put('/admin/staffs/{id}', [StaffController::class, 'update'])->name('staffs.update');
    
    // 4. Menambahkan rute untuk memproses Hapus Akun Staf (Method DELETE)
    Route::delete('/admin/staffs/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');
    
    // 5. RUTE BARU UNTUK TAMBAH STAF
    Route::get('/admin/staffs/create', [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/admin/staffs', [StaffController::class, 'store'])->name('staffs.store');
    
    // =========================================================================

    Route::get('/admin/orders', [OrderController::class, 'index']);

    // REVISI MANAGE HOME ADMIN: Ditambahkan logic memindai folder foto agar sinkron
    Route::get('/admin/manage-home', function () {
        $galleryPath = public_path('image/Foto');
        $galleryFiles = [];

        if (File::exists($galleryPath)) {
            $files = File::files($galleryPath);
            foreach ($files as $file) {
                $filename = $file->getFilename();
                // Abaikan gambar utama hero agar tidak masuk ke list hapus galeri
                if ($filename !== 'Gambar-kolase-cewe.jpg') {
                    $galleryFiles[] = $filename;
                }
            }
        }

        return view('admin.manageHome', compact('galleryFiles'));
    })->name('admin.manage-home');

    // RUTE BARU ADMIN: Untuk menghapus file foto secara fisik dari folder
    Route::delete('/admin/manage-home/gallery/{fileName}', function ($fileName) {
        $filePath = public_path('image/Foto/' . $fileName);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        return redirect()->back()->with('success', 'Foto lookbook berhasil dihapus!');
    })->name('admin.home.delete-gallery');

    // SINKRONISASI PROSES UPLOAD GAMBAR
    Route::post('/admin/manage-home/upload', function (\Illuminate\Http\Request $request) {
        
        // Kita langsung ambil file-nya, baik dikirim sebagai array (multiple) atau satuan
        $files = $request->file('gallery_files');

        if ($files) {
            // Memastikan formatnya menjadi array agar bisa di-looping safely
            $fileArray = is_array($files) ? $files : [$files];

            foreach ($fileArray as $file) {
                // Ambil nama asli file gambar (misal: baju-keren.jpg)
                $filename = $file->getClientOriginalName();
                
                // Pindahkan langsung ke folder target tujuan kamu
                $file->move(public_path('image/Foto'), $filename);
            }

            // Kembali ke halaman admin sambil bawa flash session sukses
            return redirect()->back()->with('success', 'Gambar baru berhasil diunggah ke website!');
        }

        // Kalau ternyata file-nya terlewat/tidak terbaca, lempar status error
        return redirect()->back()->with('error', 'Gagal mengunggah, file tidak terbaca oleh server.');
    })->name('admin.home.upload-gallery');

    // RUTE BARU ADMIN: Mengolah perubahan Headline Hero Banner
    Route::post('/admin/manage-home/hero', function (\Illuminate\Http\Request $request) {
        // Di sini kita menangkap teks kiriman form
        $headline = $request->input('hero_headline');
        $buttonLink = $request->input('hero_button_link');

        // Kita juga siapkan jika admin mengunggah file gambar banner baru
        if ($request->hasFile('hero_image')) {
            $file = $request->file('hero_image');
            
            // Kita timpa file lama dengan nama Gambar-kolase-cewe.jpg agar langsung terupdate di user
            $filename = 'Gambar-kolase-cewe.jpg';
            $file->move(public_path('image/Foto'), $filename);
        }

        // Karena belum pakai database, data teks kita simpan ke session saja biar tidak hilang saat reload halaman
        session([
            'hero_headline' => $headline,
            'hero_button_link' => $buttonLink
        ]);

        return redirect()->back()->with('success', 'Konten Hero Banner berhasil diperbarui!');
    })->name('admin.home.update-hero');

    // RUTE BARU ADMIN: Mengolah perubahan teks Visi & Misi
    Route::post('/admin/manage-home/visi-misi', function (\Illuminate\Http\Request $request) {
        // Ambil kiriman teks dari textarea form admin
        $visi = $request->input('visi_points');
        $misi = $request->input('misi_points');

        // Kita titipkan datanya ke dalam session agar tersimpan sementara tanpa database
        session([
            'visi_points' => $visi,
            'misi_points' => $misi
        ]);

        return redirect()->back()->with('success', 'Data Visi & Misi berhasil diperbarui!');
    })->name('admin.home.update-visimisi');

    Route::get(
        '/admin/manage-catalog',
        [ManageCatalogController::class, 'index']
    );

    Route::post(
        '/admin/catalog/store',
        [ManageCatalogController::class, 'store']
    );

    Route::put(
        '/admin/catalog/update/{id}',
        [ManageCatalogController::class, 'update']
    );

    Route::delete(
        '/admin/catalog/delete/{id}',
        [ManageCatalogController::class, 'destroy']
    );

    Route::get('/admin/manage-mixmatch', fn() => view('admin.manageMixmatch'));

    Route::get('/admin/reports', fn() => view('admin.reports'));

    Route::get('/admin/size-chart/{id_category}', [ManageCatalogController::class, 'getSizeChart']);
});

Route::get('/home', function () {
    $galleryPath = public_path('image/Foto');
    $galleryFiles = [];

    if (File::exists($galleryPath)) {
        $files = File::files($galleryPath);
        foreach ($files as $file) {
            $filename = $file->getFilename();
            // Tampilkan foto di galeri jika itu bukan gambar utama hero banner
            if ($filename !== 'Gambar-kolase-cewe.jpg') {
                $galleryFiles[] = $filename;
            }
        }
    }

    return view('page.home', compact('galleryFiles'));
});

Route::get('/katalog', [KatalogController::class, 'index']);

Route::get('/mixmatch', fn() => view('page.mixmatch'));

Route::get('/cart', fn() => view('page.cart'));

Route::get('/profile', fn() => view('page.profile'));

Route::get('/addAddress', fn() => view('page.addAddress'));

Route::get('/checkout', fn() => view('page.checkout'));

Route::post('/checkout/payment', [PaymentController::class, 'payment']);