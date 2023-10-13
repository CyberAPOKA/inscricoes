<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Core\Constants\HasProductsAndKits;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->string('name');
            $table->enum('has_products_and_kits', HasProductsAndKits::values())->default(HasProductsAndKits::YES);
            
            
            $table->date('boleto_available_until')->nullable();
            $table->integer('boleto_discount')->default(0)->nullable();
            $table->date('pix_available_until')->nullable();
            $table->integer('pix_discount')->default(0)->nullable();
            $table->integer('credit_card_allow_payment_in_up_to')->default(0)->nullable();
            $table->float('credit_card_installments_permitted_for_amounts_above')->nullable();
            $table->float('credit_card_minimum_installment_value')->nullable();
            $table->date('credit_card_available_until')->nullable();
            $table->integer('credit_card_discount')->default(0)->nullable();

            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
