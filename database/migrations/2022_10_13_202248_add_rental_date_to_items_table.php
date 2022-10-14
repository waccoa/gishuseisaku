<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRentalDateToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->date('rental_date')->nullable();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rental_date');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('rental_date');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->date('rental_date')->nullable();
        });
    }
}
