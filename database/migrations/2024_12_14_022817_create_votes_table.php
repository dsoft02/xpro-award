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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('ip_address');
            $table->foreignId('nominee_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->timestamps();

            // Ensure a voter can only vote once per category (based on email + category_id OR ip_address + category_id)
            $table->unique(['email', 'category_id']);
            $table->unique(['ip_address', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
