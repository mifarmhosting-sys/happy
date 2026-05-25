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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained('members')->onDelete('cascade');
            $table->string('extra_member_name')->nullable();
            $table->integer('extra_member_age')->nullable();
            $table->date('journey_start_date');
            $table->date('journey_end_date');
            $table->string('journey_tenure'); // Store formatted tenure like "7 Days / 6 Nights"
            $table->enum('destination_type', ['Single', 'Multi']);
            $table->text('destination_details');
            $table->text('opt_ticket')->nullable();
            $table->text('opt_pickup_drop')->nullable();
            $table->text('opt_sightseeing')->nullable();
            $table->text('opt_food')->nullable();
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
