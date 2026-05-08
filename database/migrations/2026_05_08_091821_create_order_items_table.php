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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('id_order_item');

            $table->foreignId('id_order')
                ->constrained('orders', 'id_order')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('id_variant')
                ->constrained('product_variants', 'id_variant')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->decimal('price_at_purchase', 12, 2);
            $table->integer('quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
