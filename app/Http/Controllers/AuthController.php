<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
        $request->validate([

            'full_name' => 'required|max:100',

            'email' => 'required|email|unique:users,email',

            'password' => 'required|min:8'

        ]);

        User::create([

            'full_name' => $request->full_name,

            'email' => $request->email,

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
