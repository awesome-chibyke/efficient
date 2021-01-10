<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvestmentUniqueIdToRewardDisbursementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reward_disbursements', function (Blueprint $table) {
            $table->renameColumn('investment_settings_id', 'investment_unique_id');
            $table->renameColumn('reward', 'reward_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reward_disbursements', function (Blueprint $table) {
            //
        });
    }
}
