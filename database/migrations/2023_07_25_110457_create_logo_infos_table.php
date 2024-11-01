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
        Schema::create('logo_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_logo_id');

            $table->string('file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->integer('index')->nullable();

            $table->timestamps();
            $table->foreign('event_logo_id')->references('id')->on('event_logos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logo_infos');
    }
};
