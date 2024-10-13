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
        Schema::create('hot_deals', function (Blueprint $table) {
            $table->id();
            $table->string('mtitle');
            $table->string('title1');
            $table->string('title2');
            $table->string('link');
            $table->enum('status', ['active', 'pending'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hot_deals');
    }
};
