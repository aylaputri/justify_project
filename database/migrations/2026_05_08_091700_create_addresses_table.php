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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id('id_address');

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('address_title', 50);
            $table->text('complete_address');
            $table->string('city', 100);
            $table->string('province', 100);
            $table->string('postal_code', 10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
