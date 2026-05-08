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
        Schema::create('size_charts', function (Blueprint $table) {
            $table->id('id_size_chart');

            $table->foreignId('id_product')
                ->constrained('products', 'id_product')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->enum('size', [
                'S',
                'M',
                'L',
                'XL'
            ]);

            $table->integer('height_cm');
            $table->integer('shoulder_width_cm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_charts');
    }
};
