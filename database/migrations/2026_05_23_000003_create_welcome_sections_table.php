<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('welcome_sections', function (Blueprint $table) {
            $table->id();
            $table->string('tagline')->nullable();
            $table->string('title')->nullable();
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->text('accent_text')->nullable();
            $table->string('image1_path')->nullable();
            $table->string('image2_path')->nullable();
            $table->string('image3_path')->nullable();
            $table->string('image4_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('welcome_sections');
    }
};
