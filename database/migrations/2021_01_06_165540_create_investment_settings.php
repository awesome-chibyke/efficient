<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //unique_id,name_of_plan, amount, amount_for_referral, amount_for_no_referral, duration_for_referral_reward, number_to_be_referred, form_fee, no_of_days_before_reward_collection, maximum_no_of_referral
        Schema::create('investment_settings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('name_of_plan')->nullable();
            $table->decimal('amount', 13, 4)->nullable();
            $table->decimal('amount_for_referral', 13, 4)->nullable();
            $table->decimal('amount_for_no_referral', 13, 4)->nullable();
            $table->integer('duration_for_referral_reward')->nullable();
            $table->integer('number_to_be_referred')->nullable();
            $table->decimal('form_fee', 13,4)->nullable();
            $table->integer('no_of_days_before_reward_collection')->nullable();
            $table->integer('maximum_no_of_referral')->nullable();
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
        Schema::dropIfExists('investment_settings');
    }
}
