<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Traits\CommonTrait;
use CheckUserAccessHelper;
use Auth;
class ErrorComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    use CommonTrait;
    private $userName;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        if (Auth :: guard('users') -> check()) {
            $this -> userName = Auth::guard('users') -> user() -> invensis_users_name;            
        }
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with(['userName' => $this -> userName]);
    }
}
