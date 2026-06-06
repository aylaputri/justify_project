<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    // 1. Tentukan nama tabel secara eksplisit (Opsional tapi aman)
    protected $table = 'users';

    // 2. Beritahu Laravel bahwa Primary Key tabel ini adalah id_user, bukan id
    protected $primaryKey = 'id_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // 3. Sesuaikan properti fillable dengan kolom asli di database kamu
    protected $fillable = [
        'full_name',        // Menggantikan 'name' bawaan Laravel
        'email',
        'password',
        'id_google',
        'phone_number',
        'profile_picture',
        'is_active',        // Status aktif (1) atau non-aktif (0)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'integer', // Di-cast ke integer agar mudah divalidasi (0 atau 1)
        ];
    }
}