<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('rating')->default(5);
            $table->string('location')->nullable();
            $table->string('country')->nullable(); // e.g. Jamaica, Mexico, Dominican Republic, Spain
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('view_url')->default('#');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('category_hotel', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained('hotel_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_hotel');
        Schema::dropIfExists('hotels');
    }
};
