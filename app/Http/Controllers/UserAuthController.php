<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('page.login');
    }

    public function showForgotPassword()
    {
        return view(
            'page.forgotPassword'
        );
    }

    public function showRegister()
    {
        return view('page.register');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver(
            'google'
        )->redirect();
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required|max:100',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:8',
            ],
            [
                'full_name.required' => 'Nama lengkap wajib diisi',
                'full_name.max'      => 'Nama maksimal 100 karakter',
                'email.required'     => 'Email wajib diisi',
                'email.email'        => 'Format email tidak valid',
                'email.unique'       => 'Email sudah terdaftar',
                'password.required'  => 'Password wajib diisi',
                'password.min'       => 'Password minimal 8 karakter',
            ]
        );

        User::create([
            'full_name' => trim($request->full_name),
            'email'     => trim($request->email),
            'password'  => Hash::make($request->password),
            'is_active' => true,
        ]);

        // Setelah register, suruh login dulu
        return redirect('/login')->with('success', 'Akun berhasil dibuat, silakan login!');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'    => 'Email wajib diisi',
                'email.email'       => 'Format email tidak valid',
                'password.required' => 'Password wajib diisi',
            ]
        );

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah');
        }

        session([
            'user_id'    => $user->id_user,
            'user_name'  => $user->full_name,
            'user_email' => $user->email,
        ]);

        // Redirect ke home setelah login berhasil
        return redirect('/home');
    }

    public function handleGoogleCallback()
    {
        $googleUser =
            Socialite::driver(
                'google'
            )->user();

        $user = User::where(
            'email',
            $googleUser->email
        )->first();

        if (!$user) {

            $user = User::create([

                'full_name' =>
                $googleUser->name,

                'email' =>
                $googleUser->email,

                'id_google' =>
                $googleUser->id,

                'profile_picture' =>
                $googleUser->avatar,

                'is_active' => true

            ]);
        }

        session([

            'user_id' =>
            $user->id_user,

            'user_name' =>
            $user->full_name,

            'user_email' =>
            $user->email

        ]);

        return redirect('/home');
    }

    public function sendResetLink(Request $request) 
    {
        $request->validate([

            'email' =>
            'required|email'

        ]);

        $user = User::where(
            'email',
            $request->email
        )->first();

        if (!$user) {

            return back()->with(
                'error',
                'Email tidak ditemukan'
            );
        }

        $token = Str::random(64);

        DB::table(
            'password_reset_tokens'
        )->updateOrInsert(

            [
                'email' => $user->email
            ],

            [
                'token' => $token,
                'created_at' => now()
            ]

        );

        $resetLink =
            url(
                '/reset-password/' .
                    $token
            );

        Mail::raw(

            "Klik link berikut untuk mengganti password:\n\n$resetLink",

            function ($message)
            use ($user) {

                $message
                    ->to($user->email)
                    ->subject(
                        'Reset Password Savior World'
                    );
            }
        );

        return back()->with(
            'success',
            'Link reset password berhasil dikirim'
        );
    }

    public function showResetPassword($token)
    {
        return view(
            'page.resetPassword',
            compact('token')
        );
    }

    public function resetPassword(
        Request $request,
        $token
    ) {
        $request->validate([

            'password' =>
            'required|min:8|confirmed'

        ]);

        $record = DB::table(
            'password_reset_tokens'
        )
            ->where(
                'token',
                $token
            )
            ->first();

        if (!$record) {

            return redirect('/login')
                ->with(
                    'error',
                    'Link reset tidak valid'
                );
        }

        User::where(
            'email',
            $record->email
        )->update([

            'password' => Hash::make(
                $request->password
            )

        ]);

        DB::table(
            'password_reset_tokens'
        )
            ->where(
                'email',
                $record->email
            )
            ->delete();

        return redirect('/login')
            ->with(
                'success',
                'Password berhasil diubah'
            );
    }

    public function logout()
    {
        session()->forget(['user_id', 'user_name', 'user_email']);
        return redirect('/login');
    }
}