<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Core\Constants\ExtraProduct;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('event_id');
            $table->string('name');
            $table->integer('maximum_amount')->nullable();
            $table->enum('extra', ExtraProduct::values());
            $table->integer('quantity')->default(0)->nullable();

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_products');
    }
};
