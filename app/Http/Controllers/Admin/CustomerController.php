<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Memanggil Model User yang baru kita sesuaikan

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar customer dengan fitur pencarian nama/email
     */
    public function index(Request $request)
    {
        // 1. Ambil kata kunci pencarian dari input filter search
        $search = $request->input('search');

        // 2. Inisialisasi query dari model User
        $query = User::query();

        // 3. Jika user mengetik sesuatu di kolom search, lakukan filter data
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('full_name', 'LIKE', '%' . $search . '%')       // Cari berdasarkan nama lengkap
                  ->orWhere('email', 'LIKE', '%' . $search . '%')         // Cari berdasarkan email
                  ->orWhere('phone_number', 'LIKE', '%' . $search . '%'); // Cari berdasarkan nomor telepon
            });
        }

        // 4. Ambil data dengan Pagination (10 data per halaman) agar rapi seperti di UI Figma
        $customers = $query->paginate(10);

        // 5. Lempar data customers dan search ke file Blade admin/customers.blade.php
        return view('admin.customers', compact('customers', 'search'));
    }
}