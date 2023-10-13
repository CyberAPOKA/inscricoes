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
        Schema::create('event_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');

            $table->string('zip_code');
            $table->string('city');
            $table->string('state');
            $table->string('street');
            $table->string('number');
            $table->string('complement')->nullable();
            $table->longText('google_maps_link')->nullable();

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_locations');
    }
};
