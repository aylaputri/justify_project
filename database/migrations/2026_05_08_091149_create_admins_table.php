<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');

            $table->string('username', 50)->unique();
            $table->string('password', 255);
            $table->string('name', 100);

            $table->enum('role', [
                'Super Admin',
                'Staff'
            ])->default('Staff');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('last_login')->nullable();

            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
