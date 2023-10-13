<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cnpj')->nullable();
            $table->string('cellphone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidphone_number
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('cnpj');
            $table->dropColumn('cellphone');
        });
    }
}
