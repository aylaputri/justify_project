<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $primaryKey = 'id_admin';

    public $timestamps = false;

    // KODE SUDAH DISESUAIKAN: Menambahkan 'permissions' dan 'status' agar diizinkan masuk ke database
    protected $fillable = [
        'username',
        'password',
        'name',
        'role',
    ];
}