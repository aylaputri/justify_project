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
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id('id_log');

            $table->foreignId('id_order')
                ->constrained('orders', 'id_order')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('payment_type', 50);
            $table->string('transaction_id', 100);

            $table->decimal('gross_amount', 12, 2);

            $table->text('response_payload');

            $table->timestamp('created_at')
                ->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_logs');
    }
};
