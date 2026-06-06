<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | LOGIN PAGE
    |--------------------------------------------------------------------------
    */

    public function showLogin()
    {
        return view('page.login');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER PAGE
    |--------------------------------------------------------------------------
    */

    public function showRegister()
    {
        return view('page.register');
    }

    /*
    |--------------------------------------------------------------------------
    | REGISTER
    |--------------------------------------------------------------------------
    */

    public function register(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required|max:100',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8'
            ],
            [
                'full_name.required' => 'Nama lengkap wajib diisi',
                'full_name.max' => 'Nama maksimal 100 karakter',

                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',

                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password minimal 8 karakter'
            ]
        );

        User::create([

            'full_name' => trim(
                $request->full_name
            ),

            'email' => trim(
                $request->email
            ),

            'password' => Hash::make(
                $request->password
            ),

            'is_active' => true

        ]);

        return redirect('/login')
            ->with(
                'success',
                'Akun berhasil dibuat'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOGIN
    |--------------------------------------------------------------------------
    */

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password wajib diisi'
            ]
        );
        
        $user = User::where(
            'email',
            $request->email
        )->first();

        if (
            !$user ||
            !Hash::check(
                $request->password,
                $user->password
            )
        ) {

            return back()->with(
                'error',
                'Email atau password salah'
            );
        }

        session([

            'user_id' => $user->id_user,

            'user_name' => $user->full_name,

            'user_email' => $user->email

        ]);

        return redirect('/');
    }

    /*
    |--------------------------------------------------------------------------
    | LOGOUT
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        session()->forget([

            'user_id',

            'user_name',

            'user_email'

        ]);

        return redirect('/login');
    }
}
