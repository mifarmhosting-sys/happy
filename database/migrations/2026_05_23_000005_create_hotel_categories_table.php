<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique(); // e.g. 'all', 'adults', 'spa', 'wedding'
            $table->string('icon_svg', 1000)->nullable(); // Option to store SVG icon paths or full SVG tag
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_categories');
    }
};
