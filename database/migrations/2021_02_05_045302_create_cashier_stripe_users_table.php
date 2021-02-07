<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashierStripeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashier_stripe_users', function (Blueprint $table) {
            $table->increments('cashier_stripe_users_id',10)->key();
            $table->string('cashier_stripe_users_name',255);
            $table->string('cashier_stripe_users_userid',255);
            $table->string('cashier_stripe_users_email',191)->unique();
            $table->string('cashier_stripe_users_password',191)->nullable();
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->boolean('cashier_stripe_users_isactive',1)->default(true);
            $table->boolean('cashier_stripe_users_isdeleted',1)->default(false);
            $table->dateTime('cashier_stripe_users_created_at') -> nullable();
            $table->dateTime('cashier_stripe_users_updated_at') -> nullable();
            $table->string('cashier_stripe_users_forget_password_requested',1) -> nullable();
            $table->string('cashier_stripe_users_forget_password_link',255) -> nullable();;
            $table->string('cashier_stripe_users_forget_password_link_status',1) -> nullable();
            $table->dateTime('cashier_stripe_users_forget_password_link_expiration_time')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashier_stripe_users');
    }
}
