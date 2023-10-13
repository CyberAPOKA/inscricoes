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
        Schema::create('credit_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_inscription_id');

            $table->integer('number_of_installments')->nullable();
            // $table->float('installments_permitted_for_amounts_above')->nullable();
            // $table->float('minimum_installment_value')->nullable();
            // $table->date('available_until');
            // $table->integer('discount')->default(0);

            $table->foreign('event_inscription_id')->references('id')->on('event_inscriptions')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_cards');
    }
};