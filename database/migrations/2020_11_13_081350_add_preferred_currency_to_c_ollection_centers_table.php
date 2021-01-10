<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPreferredCurrencyToCOllectionCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_ollection_centers', function (Blueprint $table) {
            $table->string('preferred_currency')->default('RTA76f166edd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_ollectioncenters', function (Blueprint $table) {
            //
        });
    }
}
