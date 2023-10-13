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
        Schema::create('route_inscriptions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('event_route_id');
            $table->unsignedBigInteger('event_inscription_id');
            
            $table->timestamps();

            $table->foreign('event_route_id')->references('id')->on('event_routes')->onDelete('cascade');
            $table->foreign('event_inscription_id')->references('id')->on('event_inscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_inscriptions');
    }
};
