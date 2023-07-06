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
        Schema::create('estimate_field_values', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->integer('time')->nullable();
            $table->integer('startup_time')->nullable();
            $table->integer('total_percentage')->nullable();
            $table->timestamps();

            $table->foreignId('estimate_field_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estimate_field_values');
    }
};
