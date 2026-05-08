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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');

            $table->foreignId('id_user')
                ->constrained('users', 'id_user')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreignId('id_address')
                ->constrained('addresses', 'id_address')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->text('shipping_address');

            $table->decimal('total_product_price', 12, 2);
            $table->decimal('shipping_cost', 12, 2);
            $table->decimal('grand_total', 12, 2);

            $table->string('shipping_method', 50);

            $table->string('payment_method', 20)
                ->default('QRIS');

            $table->enum('status', [
                'Pending',
                'Diproses',
                'Dikirim',
                'Selesai',
                'Dibatalkan',
                'Refund'
            ]);

            $table->timestamp('order_date')
                ->useCurrent();

            $table->string('tracking_number', 50)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
