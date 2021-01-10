<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//unique_id, investment_settings_id, no_of_days, time_regulator, form_amount_dispensation_status, referral_id
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('investment_settings_id')->nullable();
            $table->integer('no_of_days')->nullable();
            $table->dateTime('time_regulator')->nullable();
            $table->string('form_amount_dispensation_status')->default('no');
            $table->string('referral_id')->nullable();
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
        Schema::dropIfExists('investments');
    }
}
