<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $userId      = session('user_id');
        $user        = User::find($userId);
        $statusCount = [
            'Pending'    => Order::where('id_user', $userId)->where('status', 'Pending')->count(),
            'Diproses'   => Order::where('id_user', $userId)->where('status', 'Diproses')->count(),
            'Dikirim'    => Order::where('id_user', $userId)->where('status', 'Dikirim')->count(),
            'Selesai'    => Order::where('id_user', $userId)->where('status', 'Selesai')->count(),
            'Dibatalkan' => Order::where('id_user', $userId)->where('status', 'Dibatalkan')->count(),
            'Refund'     => Order::where('id_user', $userId)->where('status', 'Refund')->count(),
        ];
        return view('page.profile', compact('user', 'statusCount'));
    }

    public function edit()
    {
        $user = User::find(session('user_id'));
        return view('page.editProfile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(session('user_id'));

        // Validasi email unik (kecuali milik user sendiri)
        $request->validate([
            'full_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email,' . $user->id_user . ',id_user',
            'phone_number' => 'nullable|string|max:20',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'email.unique' => 'Email sudah digunakan oleh akun lain.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.max'   => 'Ukuran foto maksimal 2MB.',
        ]);

        // Update foto profil
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profiles', 'public');
            $user->profile_picture = $path;
        }

        // Update data dasar
        $user->full_name    = $request->full_name;
        $user->email        = $request->email;
        $user->phone_number = $request->phone_number;

        // Ganti password jika diisi
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password lama tidak sesuai.')->withInput();
            }
            if ($request->new_password !== $request->new_password_confirmation) {
                return back()->with('error', 'Konfirmasi password baru tidak cocok.')->withInput();
            }
            if (strlen($request->new_password) < 8) {
                return back()->with('error', 'Password baru minimal 8 karakter.')->withInput();
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        // Update session name
        session(['user_name' => $user->full_name]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}