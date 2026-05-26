<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $admin = Admin::where(
            'username',
            $request->username
        )->first();

        if (!$admin) {
            return back()->with(
                'error',
                'Username tidak ditemukan'
            );
        }

        if (!Hash::check($request->password, $admin->password)) {
            return back()->with(
                'error',
                'Password salah'
            );
        }

        $admin->last_login = now();

        $admin->save();

        session([
            'admin' => $admin->id_admin,
            'admin_name' => $admin->name,
            'admin_role' => $admin->role
        ]);

        return redirect('/admin/dashboard');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/admin/login');
    }
}
