<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id')->unique();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('status')->default('active');
            $table->date('date_of_birth')->nullable();
            $table->string('profile_image')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('instagram')->nullable();
            $table->text('linkeden')->nullable();
            $table->string('type_of_user')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('bank_code')->nullable();
            $table->string('referer_unique_id')->nullable();
            $table->string('preferred_currency')->nullable();
            $table->decimal('balance',13,4)->default(0);
            $table->string('preferred_center')->nullable();
            $table->string('alt_password')->nullable();
            $table->string('current_login_hash')->nullable();
            $table->string('first_time_login')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
