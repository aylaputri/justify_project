<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Halaman daftar address milik user yang login
    public function index()
    {
        $addresses = Address::where('id_user', session('user_id'))->get();
        return view('page.address', compact('addresses'));
    }

    // Halaman form tambah address
    public function create()
    {
        return view('page.addAddress');
    }

    // Simpan address baru ke DB
    public function store(Request $request)
    {
        Address::create([
            'id_user'          => session('user_id'),
            'address_title'    => $request->title,
            'complete_address' => $request->address,
            'city'             => $request->city,
            'province'         => $request->province,
            'postal_code'      => $request->postal,
        ]);

        return response()->json(['success' => true]);
    }
}