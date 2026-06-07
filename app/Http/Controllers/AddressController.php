<?php
namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $userId    = session('user_id');
        $addresses = Address::where('id_user', $userId)->latest()->get();
        return view('page.address', compact('addresses'));
    }

    public function create()
    {
        return view('page.addAddress');
    }

    public function store(Request $request)
    {
        $userId  = session('user_id');
        $address = Address::create([
            'id_user'          => $userId,
            'address_title'    => $request->address_title,
            'complete_address' => $request->complete_address,
            'city'             => $request->city,
            'province'         => $request->province,
            'postal_code'      => $request->postal_code,
        ]);

        return response()->json(['success' => true, 'id_address' => $address->id_address]);
    }

    public function update(Request $request, $id)
    {
        $userId  = session('user_id');
        $address = Address::where('id_address', $id)->where('id_user', $userId)->first();

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
        }

        $address->update([
            'address_title'    => $request->address_title,
            'complete_address' => $request->complete_address,
            'city'             => $request->city,
            'province'         => $request->province,
            'postal_code'      => $request->postal_code,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Request $request, $id)
    {
        $userId  = session('user_id');
        $address = Address::where('id_address', $id)->where('id_user', $userId)->first();

        if (!$address) {
            return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
        }

        $address->delete();
        return response()->json(['success' => true]);
    }
}