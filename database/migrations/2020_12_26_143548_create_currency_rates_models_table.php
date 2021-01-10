<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyRatesModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_rates_models', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('base_currency')->nullable();
            $table->string('second_currency')->nullable();
            $table->string('rate_of_conversion')->nullable();
            $table->string('expression')->nullable();
            $table->string('currency_name')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_abbr')->nullable();
            $table->softDeletes('deleted_at', 6)->nullable();
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
        Schema::dropIfExists('currency_rates_models');
    }
}
