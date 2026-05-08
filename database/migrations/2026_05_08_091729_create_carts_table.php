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
        Schema::create('carts', function (Blueprint $table) {
            $table->id('id_cart');

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_variant')
                ->constrained('product_variants', 'id_variant')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('quantity');

            $table->timestamps();

            $table->unique(['id_user', 'id_variant']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
