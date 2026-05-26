<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->updateOrInsert(

            [
                'username' => 'admin'
            ],

            [
                'password' => Hash::make('123'),

                'name' => 'Rifdah',

                'role' => 'Super Admin',

                'last_login' => null,

                'created_at' => now(),
            ]

        );

        DB::table('admins')->updateOrInsert(

            [
                'username' => 'staff'
            ],

            [
                'password' => Hash::make('456'),

                'name' => 'Nabila',

                'role' => 'Staff',

                'last_login' => null,

                'created_at' => now(),
            ]

        );
    }
}