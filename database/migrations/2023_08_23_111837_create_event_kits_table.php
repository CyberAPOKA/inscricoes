<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Core\Constants\HaveKit;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_kits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('event_inscription_id')->nullable();

            $table->string('name')->nullable();
            $table->longText('observation')->nullable();
            $table->integer('athletes_amount')->nullable();
            $table->string('image_name')->nullable();
            $table->string('image_path')->nullable();

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('event_inscription_id')->references('id')->on('event_inscriptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_kits');
    }
};
 