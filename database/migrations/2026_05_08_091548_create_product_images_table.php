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
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('id_image');

            $table->foreignId('id_variant')
                ->constrained('product_variants', 'id_variant')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('image_url', 255);
            $table->boolean('is_main')->default(false);

            $table->unique([
                'id_variant',
                'image_url'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
