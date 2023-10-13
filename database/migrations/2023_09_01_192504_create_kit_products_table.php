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
        Schema::create('kit_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_kit_id');
            $table->unsignedBigInteger('event_product_id');
            $table->integer('quantity')->default(0)->nullable();
            
            $table->timestamps();
            $table->foreign('event_kit_id')->references('id')->on('event_kits')->onDelete('cascade');
            $table->foreign('event_product_id')->references('id')->on('event_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kit_products');
    }
};
