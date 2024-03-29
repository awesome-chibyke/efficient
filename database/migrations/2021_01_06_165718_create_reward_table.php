<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRewardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {//unique_id, investment_settings_id, reward
        Schema::create('reward_table', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('investment_settings_id')->nullable();
            $table->text('reward')->nullable();
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
        Schema::dropIfExists('reward_table');
    }
}
