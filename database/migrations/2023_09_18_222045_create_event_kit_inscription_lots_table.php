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
        Schema::create('event_kit_inscription_lots', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inscription_lot_id');
            $table->unsignedBigInteger('event_kit_id')->nullable();

            $table->integer('athletes_amount')->nullable();
            $table->integer('vacancies_number')->default(99999)->nullable();
            $table->integer('amount')->nullable();
            $table->float('value')->nullable();
            $table->float('senior_discount')->nullable();

            $table->foreign('inscription_lot_id')->references('id')->on('inscription_lots')->onDelete('cascade');
            $table->foreign('event_kit_id')->references('id')->on('event_kits')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_kit_inscription_lots');
    }
};
