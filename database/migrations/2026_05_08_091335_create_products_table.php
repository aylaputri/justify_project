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
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');

            $table->foreignId('id_category')
                ->constrained('product_categories', 'id_category')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('product_name', 150)->unique();

            $table->enum('gender', [
                'Perempuan',
                'Laki-laki'
            ]);

            $table->text('description');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
