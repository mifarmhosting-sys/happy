<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description1')->nullable();
            $table->text('description2')->nullable();
            $table->text('description3')->nullable();
            
            // Privilege Amenities card
            $table->string('amenities_title')->nullable();
            $table->text('amenities_description')->nullable();
            $table->string('amenities_image_path')->nullable();
            
            // Special Offers card
            $table->string('offers_title')->nullable();
            $table->text('offers_description')->nullable();
            $table->string('offers_image_path')->nullable();
            
            // Secondary layout image paths
            $table->string('about_image1_path')->nullable();
            $table->string('about_image2_path')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_sections');
    }
};
