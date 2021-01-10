<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('investment_settings_id')->nullable();
            $table->string('referral_id')->nullable();
            $table->string('referred_user_id')->nullable();
            $table->string('referrer_user_id')->default('no');
            $table->softDeletes('deleted_at', 6)->nullable();
            $table->timestamps();
        });
    }//unique_id, investment_settings_id, referral_id, referred_user_id,  referrer_user_id

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referrals');
    }
}
