<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;
use Validator;
use Auth;
use Config;
use CommonHelper;
use App\Models\cashier_stripe_user;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
       username as username;
        //password as password;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'restricted.dashboard.index';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:users')->except('logout');
    }
    
    protected function guard() {
        return Auth::guard('users');
    }
    
        
    public function username() {
        return 'cashier_stripe_users_userid';
    }
    
    public function password() {
        return 'cashier_stripe_users_password';
    }
    
    protected function validateLogin(Request $request) {
        //dd("hi");
        $messages = array($this->username().".required" => "User name is required",$this->username().".email" => "User name should in email format",$this->password().".required" => "Password is required");
        $validator = Validator::make(
			$request->all(),
			[
					$this->username() => 'required|email',
					$this->password() => 'required',
			],
			$messages
			)->validate();
    }
    
    public function showLoginForm() {
        return view('frontend.login.login');
    }
    
    public function doLogin(Request $request) {
        $this->validateLogin($request);
        if($this->guard()->attempt($this->credentials($request))){
            //dd("hi");
            return $this->sendLoginResponse($request);
            //$this->authenticated($request, $this->guard()->user());
        }
        else {
            //dd("hi");
            return redirect()->back()->withInput()->with("vmessage","Incorrect login lnformation, please enter valid information.");
            //redirect('/')->with("vmessage","Incorrect login lnformation, please enter valid information.");
        }
    }
    
    protected function sendLoginResponse(Request $request) {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        
        
        //echo Config::get('app.userRole');
        
        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->route('getLogin')->with("vmessage","Some Error Occured!!! Please Login Again");
    }
    
    
    protected function authenticated(Request $request, $user) {
//        dd($user -> daddy_users_isactive);
        if($user -> cashier_stripe_users_isactive == "1" && $user -> cashier_stripe_users_isdeleted == "0") {
            return redirect()->route('restricted.dashboard.index');
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect()->back()->withInput()->with("vmessage","User is not active or deleted!!! Please try again");
        }
    }
    
    protected function credentials(Request $request) {
        //dd($request);
        return $request->only($this->username(), $this->password());
    }
    
    public function logout(Request $request) {
        $this->guard()->logout();
        $request->session()->invalidate();
        return redirect()->route('getLogin')->with("vmessage","You are successfully logged out");
//        return redirect('/login')->with("vmessage","You are successfully logged out");
    }
    
}
