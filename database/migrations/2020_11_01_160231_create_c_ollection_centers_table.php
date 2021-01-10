<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCOllectionCentersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_ollection_centers', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->string('address');
            $table->string('city_town');
            $table->string('state_region_province');
            $table->string('country');
            $table->softDeletes('deleted_at', 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('c_ollection_centers');
    }

}
