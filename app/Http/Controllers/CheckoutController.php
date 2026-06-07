<?php
namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $userId    = session('user_id');
        $addressId = session('checkout_address_id');
        $address   = null;

        if ($addressId) {
            $address = Address::where('id_address', $addressId)
                               ->where('id_user', $userId)
                               ->first();
        }

        return view('page.checkout', compact('address'));
    }

    public function setAddress(Request $request)
    {
        $userId    = session('user_id');
        $addressId = $request->id_address;

        // Validasi alamat milik user ini
        $address = Address::where('id_address', $addressId)
                           ->where('id_user', $userId)
                           ->first();

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
        }

        session(['checkout_address_id' => $addressId]);

        return response()->json(['success' => true]);
    }
}