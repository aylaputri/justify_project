<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('size_charts', function (Blueprint $table) {

            // hapus foreign key dulu
            $table->dropForeign(['id_product']);

            // baru hapus kolom
            $table->dropColumn('id_product');

            // tambah kolom baru
            $table->unsignedBigInteger('id_category')->after('id_size_chart');

        });
    }

    public function down(): void
    {
        Schema::table('size_charts', function (Blueprint $table) {

            $table->dropColumn('id_category');

            $table->unsignedBigInteger('id_product');

        });
    }
};