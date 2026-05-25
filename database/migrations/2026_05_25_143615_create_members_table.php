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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id')->unique();
            $table->string('password');
            $table->string('customer_name');
            $table->integer('age')->nullable();
            $table->string('co_customer_name')->nullable();
            $table->integer('co_customer_age')->nullable();
            $table->string('kid_1_name')->nullable();
            $table->integer('kid_1_age')->nullable();
            $table->string('kid_2_name')->nullable();
            $table->integer('kid_2_age')->nullable();
            $table->text('address')->nullable();
            $table->string('mobile_1');
            $table->string('mobile_2')->nullable();
            $table->string('email');
            $table->date('membership_issue_date')->nullable();
            $table->date('membership_expiry_date')->nullable();
            $table->string('membership_category')->default('New Member');
            $table->text('membership_terms')->nullable();
            $table->string('profile_image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
