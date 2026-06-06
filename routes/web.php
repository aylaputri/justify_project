<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManageCatalogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;

// =====================
// ROOT
// =====================
Route::get('/', function () {
    if (session()->has('user_id')) {
        return redirect('/home');
    }
    return redirect('/login');
});

// =====================
// ADMIN AUTH (public)
// =====================
Route::get('/admin/login',  [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// =====================
// ADMIN PROTECTED
// =====================
Route::middleware('admin')->prefix('admin')->group(function () {

    Route::get('/dashboard',       [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile',         fn() => view('admin.profile'))->name('admin.profile');
    Route::get('/reports',         fn() => view('admin.reports'))->name('admin.reports');
    Route::get('/manage-mixmatch', fn() => view('admin.manageMixmatch'))->name('admin.manage-mixmatch');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Staffs
    Route::get('/staffs',           [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staffs/create',    [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/staffs',          [StaffController::class, 'store'])->name('staffs.store');
    Route::get('/staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::put('/staffs/{id}',      [StaffController::class, 'update'])->name('staffs.update');
    Route::delete('/staffs/{id}',   [StaffController::class, 'destroy'])->name('staffs.destroy');

    // Orders
    Route::get('/orders',             [OrderController::class, 'index'])->name('admin.orders');
    Route::put('/orders/update/{id}', [OrderController::class, 'update'])->name('admin.orders.update');

    // Catalog
    Route::get('/manage-catalog',         [ManageCatalogController::class, 'index'])->name('admin.catalog');
    Route::post('/catalog/store',         [ManageCatalogController::class, 'store'])->name('admin.catalog.store');
    Route::put('/catalog/update/{id}',    [ManageCatalogController::class, 'update'])->name('admin.catalog.update');
    Route::delete('/catalog/delete/{id}', [ManageCatalogController::class, 'destroy'])->name('admin.catalog.destroy');
    Route::get('/size-chart/{id_category}', [ManageCatalogController::class, 'getSizeChart'])->name('admin.size-chart');

    // Manage Home
    Route::get('/manage-home', function () {
        $galleryPath  = public_path('image/Foto');
        $galleryFiles = [];
        if (File::exists($galleryPath)) {
            foreach (File::files($galleryPath) as $file) {
                if ($file->getFilename() !== 'Gambar-kolase-cewe.jpg') {
                    $galleryFiles[] = $file->getFilename();
                }
            }
        }
        return view('admin.manageHome', compact('galleryFiles'));
    })->name('admin.manage-home');

    Route::delete('/manage-home/gallery/{fileName}', function ($fileName) {
        $filePath = public_path('image/Foto/' . $fileName);
        if (File::exists($filePath)) File::delete($filePath);
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    })->name('admin.home.delete-gallery');

    Route::post('/manage-home/upload', function (\Illuminate\Http\Request $request) {
        $files = $request->file('gallery_files');
        if ($files) {
            foreach (is_array($files) ? $files : [$files] as $file) {
                $file->move(public_path('image/Foto'), $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
        }
        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    })->name('admin.home.upload-gallery');

    Route::post('/manage-home/hero', function (\Illuminate\Http\Request $request) {
        if ($request->hasFile('hero_image')) {
            $request->file('hero_image')->move(public_path('image/Foto'), 'Gambar-kolase-cewe.jpg');
        }
        session([
            'hero_headline'    => $request->input('hero_headline'),
            'hero_button_link' => $request->input('hero_button_link'),
        ]);
        return redirect()->back()->with('success', 'Hero Banner berhasil diperbarui!');
    })->name('admin.home.update-hero');

    Route::post('/manage-home/visi-misi', function (\Illuminate\Http\Request $request) {
        session([
            'visi_points' => $request->input('visi_points'),
            'misi_points' => $request->input('misi_points'),
        ]);
        return redirect()->back()->with('success', 'Visi & Misi berhasil diperbarui!');
    })->name('admin.home.update-visimisi');
});

// =====================
// USER AUTH (public)
// =====================
Route::get('/login',    [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [UserAuthController::class, 'login']);
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register',[UserAuthController::class, 'register']);
Route::get('/logout',   [UserAuthController::class, 'logout'])->name('logout');

// =====================
// USER PROTECTED
// =====================
Route::middleware('user')->group(function () {

    Route::get('/home', function () {
        $galleryPath  = public_path('image/Foto');
        $galleryFiles = [];
        if (File::exists($galleryPath)) {
            foreach (File::files($galleryPath) as $file) {
                if ($file->getFilename() !== 'Gambar-kolase-cewe.jpg') {
                    $galleryFiles[] = $file->getFilename();
                }
            }
        }
        return view('page.home', compact('galleryFiles'));
    })->name('home');

    Route::get('/katalog',  [KatalogController::class, 'index'])->name('katalog');
    Route::get('/mixmatch', fn() => view('page.mixmatch'))->name('mixmatch');
    Route::get('/cart',     fn() => view('page.cart'))->name('cart');

    Route::get('/profile', function () {
        $userId      = session('user_id');
        $user        = \App\Models\User::find($userId);
        $statusCount = [
            'Pending'    => \App\Models\Order::where('id_user', $userId)->where('status', 'Pending')->count(),
            'Diproses'   => \App\Models\Order::where('id_user', $userId)->where('status', 'Diproses')->count(),
            'Dikirim'    => \App\Models\Order::where('id_user', $userId)->where('status', 'Dikirim')->count(),
            'Selesai'    => \App\Models\Order::where('id_user', $userId)->where('status', 'Selesai')->count(),
            'Dibatalkan' => \App\Models\Order::where('id_user', $userId)->where('status', 'Dibatalkan')->count(),
            'Refund'     => \App\Models\Order::where('id_user', $userId)->where('status', 'Refund')->count(),
        ];
        return view('page.profile', compact('user', 'statusCount'));
    })->name('profile');

    // Address
    Route::get('/address',     [AddressController::class, 'index'])->name('address');
    Route::get('/addAddress',  [AddressController::class, 'create'])->name('addAddress');
    Route::post('/addAddress', [AddressController::class, 'store'])->name('addAddress.store');

    Route::get('/checkout',   fn() => view('page.checkout'))->name('checkout');
    Route::post('/checkout/payment', [PaymentController::class, 'payment'])->name('payment.process');
    Route::get('/invoice/{id}',      [PaymentController::class, 'invoice'])->name('payment.invoice');
});

// =====================
// MIDTRANS WEBHOOK (skip CSRF)
// =====================
Route::post('/checkout/notification', [PaymentController::class, 'notification'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
    ->name('payment.notification');

// =====================
// DEBUG (hapus setelah selesai)
// =====================
Route::get('/debug-session', function () {
    return response()->json([
        'user_id'   => session('user_id'),
        'user_name' => session('user_name'),
    ]);
});