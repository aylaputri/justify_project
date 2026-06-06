<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('id_user', session('user_id'))->get();
        return view('page.address', compact('addresses'));
    }

    public function create()
    {
        return view('page.addAddress');
    }

    public function store(Request $request)
    {
        try {
            Address::create([
                'id_user'          => session('user_id'),
                'address_title'    => $request->title,
                'complete_address' => $request->address,
                'city'             => $request->city,
                'province'         => $request->province,
                'postal_code'      => $request->postal,
            ]);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $address = Address::where('id_address', $id)
                              ->where('id_user', session('user_id'))
                              ->first();

            if (!$address) {
                return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
            }

            $address->update([
                'address_title'    => $request->title,
                'complete_address' => $request->address,
                'city'             => $request->city,
                'province'         => $request->province,
                'postal_code'      => $request->postal,
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $address = Address::where('id_address', $id)
                              ->where('id_user', session('user_id'))
                              ->first();

            if (!$address) {
                return response()->json(['success' => false, 'message' => 'Alamat tidak ditemukan'], 404);
            }

            // Lepas referensi dari orders supaya tidak kena foreign key constraint
            Order::where('id_address', $id)->update(['id_address' => null]);

            $address->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}