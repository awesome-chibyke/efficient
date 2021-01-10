<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('site_name')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('site_url')->nullable();
            $table->string('logo_url')->nullable();
            $table->text('facebook')->nullable();
            $table->text('instagram')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('phone3')->nullable();
            $table->string('no_days_cut_for_referral')->nullable();
            $table->string('least_withdrawable_amount')->nullable();
            $table->string('no_of_days_to_review')->nullable();
            $table->string('total_projects')->nullable();
            $table->text('address_3')->nullable();
            $table->text('address4')->nullable();
            $table->text('slot_setup')->nullable();
            $table->softDeletes('deleted_at',6);
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
        Schema::dropIfExists('app_settings');
    }
}
