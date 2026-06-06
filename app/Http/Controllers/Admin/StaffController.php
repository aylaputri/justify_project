<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; 

class StaffController extends Controller
{
    // MENAMPILKAN DAFTAR STAF (Dengan Fitur Pencarian Nama & Role)
    public function index(Request $request)
    {
        // Ambil data kata kunci dari input search
        $search = $request->input('search');

        // Query dasar mengambil data dari model Admin
        $query = Admin::query();

        // Jika user mengetikkan sesuatu di kolom pencarian
        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')       // Mencari berdasarkan nama lengkap
                  ->orWhere('username', 'LIKE', '%' . $search . '%') // Mencari berdasarkan username
                  ->orWhere('role', 'LIKE', '%' . $search . '%');     // Mencari berdasarkan role
            });
        }

        // Ambil hasil akhirnya
        $staffs = $query->get(); 

        // Kirim data staffs dan juga kata kunci search agar text di input tidak hilang setelah disubmit
        return view('admin.staffs', compact('staffs', 'search')); 
    }

    // 2. MENAMPILKAN FORM EDIT STAF
    public function edit($id)
    {
        // Mencari data berdasarkan id_admin
        $staff = Admin::where('id_admin', $id)->firstOrFail();
        return view('admin.edit_staff', compact('staff')); 
    }

    // 3. MEMPROSES UPDATE DATA STAF
    public function update(Request $request, $id)
    {
        // KODE SUDAH DIBERSIHKAN: Validasi menangkap input 'username' dari HTML Blade yang baru
        $request->validate([
            'username'    => 'required|string|max:255',
            'name'        => 'required|string|max:255',
            'role'        => 'required|in:Super Admin,Staff', 
        ]);

        // Cari data berdasarkan primary key asli database (id_admin)
        $staff = Admin::where('id_admin', $id)->firstOrFail();
    
        // Eksekusi update data ke database
        $staff->update([
            'username'    => $request->username,    
            'name'        => $request->name,
            'role'        => $request->role,        
        ]);

        // Kembali ke halaman index dengan membawa alert sukses
        return redirect()->route('staffs.index')->with('success', 'Data staf berhasil diperbarui!');
    }

    // 1. MENAMPILKAN FORM TAMBAH STAF
    public function create()
    {
        return view('admin.add_staff'); // Membuka file form tambah yang kita buat tadi
    }

    // 2. MEMPROSES PENYIMPANAN DATA STAF BARU
    public function store(Request $request)
    {
        // Validasi input data sesuai kolom database asli
        $request->validate([
            'username' => 'required|string|max:255|unique:admins,username', // Username tidak boleh kembar
            'name'     => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:Super Admin,Staff',
        ]);

        // Simpan data staf baru ke database
        Admin::create([
            'username' => $request->username,
            'name'     => $request->name,
            'password' => bcrypt($request->password), // Password wajib di-hash demi keamanan login
            'role'     => $request->role,
        ]);

        // Redirect kembali ke halaman utama tabel staf dengan notifikasi sukses
        return redirect()->route('staffs.index')->with('success', 'Akun staf baru berhasil didaftarkan!');
    }

    // 4. MEMPROSES HAPUS STAF
    public function destroy($id)
    {
        // Menggunakan id_admin agar proses hapus tidak error
        $staff = Admin::where('id_admin', $id)->firstOrFail();
        $staff->delete();

        return redirect()->route('staffs.index')->with('success', 'Akun staf berhasil dihapus!');
    }
}