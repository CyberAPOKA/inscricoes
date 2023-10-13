<?php

use App\Core\Constants\OneMoreDay;
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
        Schema::create('event_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');

            $table->string('organizer');
            $table->string('category');
            $table->date('date');
            $table->time('hour');
            $table->date('final_date')->nullable();
            $table->time('final_hour')->nullable();
            $table->enum('one_more_day', OneMoreDay::values());
            $table->date('start_disclosure_date');
            $table->time('start_disclosure_hour');
            $table->date('end_disclosure_date');
            $table->time('end_disclosure_hour');
            $table->longText('description');
            $table->longText('terms_and_conditions');
            $table->longText('observation')->nullable();
            $table->integer('maximum_amount_tickets');

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_data');
    }
};
