<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserResetPasswordNotification;
use Laravel\Cashier\Billable;

class cashier_stripe_user extends Authenticatable
{
    use Notifiable, Billable;
    
    const CREATED_AT = 'cashier_stripe_users_created_at';
    const UPDATED_AT = 'cashier_stripe_users_updated_at';
    
    protected $guard = 'users';
    
    protected $table='cashier_stripe_users';
    
    protected $primaryKey = 'cashier_stripe_users_id';
    
    protected $fillable = [
        'cashier_stripe_users_name', 'cashier_stripe_users_userid', 'cashier_stripe_users_email', 'cashier_stripe_users_password', 'cashier_stripe_users_login_token', 'cashier_stripe_users_isactive', 'cashier_stripe_users_forget_password_requested', 'cashier_stripe_users_forget_password_link', 'cashier_stripe_users_forget_password_link_status', 'cashier_stripe_users_forget_password_link_expiration_time', 'cashier_stripe_users_isdeleted',
    ];
    
    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];
    
    public function getEmailForPasswordReset() {
        return $this->cashier_stripe_users_email;
    }
    
    public function getAuthPassword() {
        return $this->cashier_stripe_users_password;
    }

    public function routeNotificationFor($driver) {
        if (method_exists($this, $method = 'routeNotificationFor'.Str::studly($driver))) {
            return $this->{$method}();
        }

        switch ($driver) {
            case 'database':
                return $this->notifications();
            case 'mail':
                return $this->cashier_stripe_users_email;
            case 'nexmo':
                return $this->phone_number;
        }
    }
}
