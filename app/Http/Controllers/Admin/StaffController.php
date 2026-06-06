<?php

namespace App\Http\Controllers\Admin; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; // Sesuaikan dengan nama Model Admin/User di projectmu

class StaffController extends Controller
{
    // 1. MENAMPILKAN DAFTAR STAF (Halaman Utama)
    public function index()
    {
        $staffs = Admin::all(); 
        return view('admin.staffs', compact('staffs')); // File index utama kamu
    }

    // 2. MENAMPILKAN FORM EDIT STAF
    public function edit($id)
    {
        // Menggunakan where karena nama kolom primary key di databasemu adalah id_admin
        $staff = Admin::where('id_admin', $id)->firstOrFail();
        
        // DISESUAIKAN: Sekarang langsung mencari file resources/views/admin/edit.blade.php
        return view('admin.edit_staff', compact('staff')); 
    }

    // 3. MEMPROSES UPDATE DATA STAF
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string',
            'permissions' => 'required|string|max:255',
            'status' => 'required|in:Aktif,Non Aktif'
        ]);

        $staff = Admin::findOrFail($id);
        
        $staff->update([
            'name' => $request->name,
            'role' => $request->role,
            'permissions' => $request->permissions,
            'status' => $request->status, 
        ]);

        return redirect()->route('staffs.index')->with('success', 'Data staf berhasil diperbarui!');
    }

    // 4. MEMPROSES HAPUS STAF
    public function destroy($id)
    {
        $staff = Admin::findOrFail($id);
        $staff->delete();

        return redirect()->route('staffs.index')->with('success', 'Akun staf berhasil dihapus!');
    }
}