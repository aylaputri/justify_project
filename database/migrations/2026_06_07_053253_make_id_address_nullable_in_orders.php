<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_address']);
            $table->unsignedBigInteger('id_address')->nullable()->change();
            $table->foreign('id_address')
                  ->references('id_address')
                  ->on('addresses')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['id_address']);
            $table->unsignedBigInteger('id_address')->nullable(false)->change();
            $table->foreign('id_address')
                  ->references('id_address')
                  ->on('addresses')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
    }
};