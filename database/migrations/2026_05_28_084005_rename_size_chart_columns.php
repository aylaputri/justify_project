<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('size_charts', function (Blueprint $table) {

            $table->renameColumn('height_cm', 'length_cm');

            $table->renameColumn('shoulder_width_cm', 'width_cm');

        });
    }

    public function down(): void
    {
        Schema::table('size_charts', function (Blueprint $table) {

            $table->renameColumn('length_cm', 'height_cm');

            $table->renameColumn('width_cm', 'shoulder_width_cm');

        });
    }
};