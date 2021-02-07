<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\cashier_stripe_user;

class cashier_stripe_users_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cashier_stripe_user = cashier_stripe_user::create(array("cashier_stripe_users_name" => "Super Admin", "cashier_stripe_users_userid" => "superadmin@test.com", "cashier_stripe_users_email" => "superadmin@test.com", "cashier_stripe_users_password" => CommonHelper::encrip_password("test@321", "e"), "cashier_stripe_users_isactive" => 1, "cashier_stripe_users_isdeleted" => 0, "cashier_stripe_users_created_at" => new Carbon, "cashier_stripe_users_updated_at" => new Carbon, "cashier_stripe_users_forget_password_requested" => 1, "cashier_stripe_users_forget_password_link" => null, "cashier_stripe_users_forget_password_link_status" => null, "cashier_stripe_users_forget_password_link_expiration_time" => null ));
    }
}
