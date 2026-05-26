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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('id_variant');

            $table->foreignId('id_product')
                ->constrained('products', 'id_product')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->string('color', 30);

            $table->enum('size', [
                'S',
                'M',
                'L',
                'XL'
            ]);

            $table->decimal('price', 12, 2);
            $table->integer('stock');

            $table->enum('status', [
                'Ready',
                'Out of Stock',
                'Hidden'
            ])->default('Ready');

            $table->timestamps();
            $table->softDeletes();

            $table->unique([
                'id_product',
                'color',
                'size'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
