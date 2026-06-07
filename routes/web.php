<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ManageCatalogController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\StaffController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Admin\ManageOrderController;

// ── ROOT ────────────────────────────────────────────────
Route::get('/', function () {
    if (session()->has('user_id')) return redirect('/home');
    return redirect('/login');
});

// ── ADMIN AUTH (Public) ─────────────────────────────────
Route::get('/admin/login',  [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// ── ADMIN PROTECTED ─────────────────────────────────────
Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard',       [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile',         fn() => view('admin.profile'))->name('admin.profile');
    Route::get('/reports',         fn() => view('admin.reports'))->name('admin.reports');
    Route::get('/manage-mixmatch',             [AdminMixMatchController::class, 'index'])->name('admin.manageMixmatch.index');
    Route::get('/manage-mixmatch/create',      [AdminMixMatchController::class, 'create'])->name('admin.manageMixmatch.create');
    Route::post('/manage-mixmatch/store',      [AdminMixMatchController::class, 'store'])->name('admin.manageMixmatch.store');
    Route::get('/manage-mixmatch/{id}/edit',   [AdminMixMatchController::class, 'edit'])->name('admin.manageMixmatch.edit');
    Route::put('/manage-mixmatch/update/{id}', [AdminMixMatchController::class, 'update'])->name('admin.manageMixmatch.update');
    Route::delete('/manage-mixmatch/delete/{id}', [AdminMixMatchController::class, 'destroy'])->name('admin.manageMixmatch.destroy');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');

    // Staffs
    Route::get('/staffs',           [StaffController::class, 'index'])->name('staffs.index');
    Route::get('/staffs/create',    [StaffController::class, 'create'])->name('staffs.create');
    Route::post('/staffs',          [StaffController::class, 'store'])->name('staffs.store');
    Route::get('/staffs/{id}/edit', [StaffController::class, 'edit'])->name('staffs.edit');
    Route::put('/staffs/{id}',      [StaffController::class, 'update'])->name('staffs.update');
    Route::delete('/staffs/{id}',   [StaffController::class, 'destroy'])->name('staffs.destroy');

    // Admin Orders (Sekarang menggunakan ManageOrderController sesuai request-mu)
    Route::get('/orders',      [ManageOrderController::class, 'index'])->name('admin.orders');
    Route::put('/orders/{id}', [ManageOrderController::class, 'update'])->name('admin.orders.update');

    // Catalog
    Route::get('/manage-catalog',           [ManageCatalogController::class, 'index'])->name('admin.catalog');
    Route::post('/catalog/store',           [ManageCatalogController::class, 'store'])->name('admin.catalog.store');
    Route::put('/catalog/update/{id}',      [ManageCatalogController::class, 'update'])->name('admin.catalog.update');
    Route::delete('/catalog/delete/{id}',   [ManageCatalogController::class, 'destroy'])->name('admin.catalog.destroy');
    Route::get('/size-chart/{id_category}', [ManageCatalogController::class, 'getSizeChart'])->name('admin.size-chart');

    // Manage Home
    Route::get('/manage-home', function () {
        $galleryPath  = public_path('image/Foto');
        $galleryFiles = [];
        if (File::exists($galleryPath)) {
            foreach (File::files($galleryPath) as $file) {
                if ($file->getFilename() !== 'Gambar-kolase-cewe.jpg')
                    $galleryFiles[] = $file->getFilename();
            }
        }
        return view('admin.manageHome', compact('galleryFiles'));
    })->name('admin.manage-home');

    Route::delete('/manage-home/gallery/{fileName}', function ($fileName) {
        $f = public_path('image/Foto/' . $fileName);
        if (File::exists($f)) File::delete($f);
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    })->name('admin.home.delete-gallery');

    Route::post('/manage-home/upload', function (\Illuminate\Http\Request $req) {
        $files = $req->file('gallery_files');
        if ($files) {
            foreach (is_array($files) ? $files : [$files] as $file)
                $file->move(public_path('image/Foto'), $file->getClientOriginalName());
            return redirect()->back()->with('success', 'Gambar berhasil diunggah!');
        }
        return redirect()->back()->with('error', 'Gagal mengunggah file.');
    })->name('admin.home.upload-gallery');

    Route::post('/manage-home/hero', function (\Illuminate\Http\Request $req) {
        if ($req->hasFile('hero_image'))
            $req->file('hero_image')->move(public_path('image/Foto'), 'Gambar-kolase-cewe.jpg');
        session(['hero_headline' => $req->hero_headline, 'hero_button_link' => $req->hero_button_link]);
        return redirect()->back()->with('success', 'Hero Banner berhasil diperbarui!');
    })->name('admin.home.update-hero');

    Route::post('/manage-home/visi-misi', function (\Illuminate\Http\Request $req) {
        session(['visi_points' => $req->visi_points, 'misi_points' => $req->misi_points]);
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
Route::get(
    '/auth/google',
    [
        UserAuthController::class,
        'redirectToGoogle'
    ]
);

Route::get(
    '/auth/google/callback',
    [
        UserAuthController::class,
        'handleGoogleCallback'
    ]
);

// ── USER PROTECTED ──────────────────────────────────────
Route::middleware('user')->group(function () {

    Route::get('/home', function () {
        $galleryPath  = public_path('image/Foto');
        $galleryFiles = [];
        if (File::exists($galleryPath)) {
            foreach (File::files($galleryPath) as $file) {
                if ($file->getFilename() !== 'Gambar-kolase-cewe.jpg')
                    $galleryFiles[] = $file->getFilename();
            }
        }
        return view('page.home', compact('galleryFiles'));
    })->name('home');

    Route::get('/katalog',  [KatalogController::class, 'index'])->name('katalog');
    Route::get('/mixmatch', fn() => view('page.mixmatch'))->name('mixmatch');

    // Cart (Logika controller penuh dipertahankan)
    Route::get('/cart',          [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add',     [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update',  [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove',  [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/select',  [CartController::class, 'select'])->name('cart.select');
    Route::get('/cart/get-id',   [CartController::class, 'getId'])->name('cart.get-id');

    // Profile (Menggunakan ProfileController dinamis request-mu)
    Route::get('/profile',         [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit',    [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Address
    Route::get('/address',                [AddressController::class, 'index'])->name('address');
    Route::get('/addAddress',             [AddressController::class, 'create'])->name('addAddress');
    Route::post('/addAddress',            [AddressController::class, 'store'])->name('addAddress.store');
    Route::post('/address/{id}/update',   [AddressController::class, 'update'])->name('address.update');
    Route::post('/address/{id}/delete',   [AddressController::class, 'destroy'])->name('address.destroy');

    // Checkout Helpers
    Route::post('/checkout/select-address', function (\Illuminate\Http\Request $req) {
        $address = \App\Models\Address::where('id_address', $req->id_address)
                       ->where('id_user', session('user_id'))->first();
        if (!$address) return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
        session(['selected_address_id' => $req->id_address]);
        return response()->json(['success' => true]);
    })->name('checkout.select-address');

    // Checkout (Logika hitung subtotal otomatis hasil pull dipertahankan)
    Route::get('/checkout', function () {
        $userId    = session('user_id');
        $addressId = session('selected_address_id');
        $address   = $addressId
            ? \App\Models\Address::where('id_address', $addressId)->where('id_user', $userId)->first()
            : \App\Models\Address::where('id_user', $userId)->latest()->first();

        $cartIds   = session('checkout_cart_ids', []);
        $cartItems = \App\Models\Cart::with(['variant.product', 'variant.images'])
                         ->whereIn('id_cart', $cartIds)
                         ->where('id_user', $userId)
                         ->get();

        $subtotal = $cartItems->sum(fn($c) => ($c->variant->price ?? 0) * $c->quantity);
        return view('page.checkout', compact('address', 'cartItems', 'subtotal'));
    })->name('checkout');

    Route::post('/checkout/payment', [PaymentController::class, 'payment'])->name('payment.process');
    Route::get('/invoice/{id}',      [PaymentController::class, 'invoice'])->name('payment.invoice');

    // Tambahan Rute Baru yang Kamu Inginkan
    Route::get('/payment-method', fn() => view('page.paymentMethod'))->name('payment.method');
    Route::get('/help',           fn() => view('page.help'))->name('help');

    // User Orders
    Route::get('/orders', function () {
        $userId       = session('user_id');
        $activeStatus = request('status', 'Semua');
        $query = \App\Models\Order::with(['items.variant.product', 'items.variant.images'])
                     ->where('id_user', $userId)->latest('order_date');
        if ($activeStatus !== 'Semua') $query->where('status', $activeStatus);
        $orders = $query->get();
        return view('page.orders', compact('orders'));
    })->name('user.orders');
});

// ── FORGOT & RESET PASSWORD ─────────────────────────────
Route::get('/forgot-password',         [UserAuthController::class, 'showForgotPassword'])->name('forgot-password');
Route::post('/forgot-password',        [UserAuthController::class, 'sendResetLink']);
Route::get('/reset-password/{token}',  [UserAuthController::class, 'showResetPassword'])->name('reset-password');
Route::post('/reset-password/{token}', [UserAuthController::class, 'resetPassword']);

// ── MIDTRANS WEBHOOK ────────────────────────────────────
Route::post('/checkout/notification', [PaymentController::class, 'notification'])
    ->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)
    ->name('payment.notification');

// ── DEBUG ───────────────────────────────────────────────
Route::get('/debug-session', function () {
    return response()->json([
        'user_id'             => session('user_id'),
        'user_name'           => session('user_name'),
        'selected_address_id' => session('selected_address_id'),
        'checkout_cart_ids'   => session('checkout_cart_ids'),
    ]);
});