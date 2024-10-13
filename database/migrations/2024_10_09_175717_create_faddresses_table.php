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
        Schema::create('faddresses', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('f_link')->nullable();
            $table->string('t_link')->nullable();
            $table->string('I_link')->nullable();
            $table->string('Y_link')->nullable();
            $table->string('p_link')->nullable();
            $table->enum('status', ['pending', 'active'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faddresses');
    }
};
