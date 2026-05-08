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
        Schema::create('user_measurements', function (Blueprint $table) {
            $table->id('id_measurement');

            $table->foreignId('id_user')
                ->unique()
                ->constrained('users', 'id_user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->decimal('weight_kg', 5, 2);
            $table->decimal('height_cm', 5, 2);

            $table->timestamp('updated_at')
                ->useCurrent()
                ->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_measurements');
    }
};
