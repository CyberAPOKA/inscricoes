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
        Schema::create('inscription_lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_inscription_id');

            $table->string('name');
            $table->date('start_date');
            $table->time('start_hour');
            $table->date('end_date');
            $table->time('end_hour');

            $table->timestamps();
            $table->foreign('event_inscription_id')->references('id')->on('event_inscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscription_lots');
    }
};
