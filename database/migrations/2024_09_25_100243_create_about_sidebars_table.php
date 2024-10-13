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
        Schema::create('about_sidebars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('about_id');
            $table->string('stitle');
            $table->text('sdescription')->nullable();
            $table->string('simage')->nullable();
            $table->enum('side', ['right', 'left'])->default('right');
            $table->timestamps();

            $table->foreign('about_id')->references('id')->on('abouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_sidebars');
    }
};
