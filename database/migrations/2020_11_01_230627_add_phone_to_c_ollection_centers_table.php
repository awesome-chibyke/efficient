<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPhoneToCOllectionCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_ollection_centers', function (Blueprint $table) {
            $table->string('team')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_ollection_centers', function (Blueprint $table) {
            //
        });
    }
}
