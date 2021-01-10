<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardDisbursementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//unique_id, investment_settings_id, reward reward_type(cash, kind)
        Schema::create('reward_disbursements', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('investment_settings_id')->nullable();
            $table->text('reward')->nullable();
            $table->string('reward_type')->nullable();
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
        Schema::dropIfExists('reward_disbursements');
    }
}
