<?php

namespace App\Http\Controllers\Restricted;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use \Illuminate\Http\Response as Res;
use App\Traits\CommonTrait;
use App\Models\cashier_stripe_product;
use App\Models\cashier_stripe_user;
use InvalidArgumentException;
use Auth;
use session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use CommonTrait;
    public $allProducts;
    
    public function index() {
        try {
            $allProducts = $this -> getAllProducts();
            $user = Auth::guard('users') -> user();
            $intent = $user -> createSetupIntent();
            return view('restricted.product', compact('allProducts', 'intent'));
        } catch(InvalidArgumentException $e) {
            return response() -> view('errors.404', [], 404); 
        }
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request -> payment_id);
//        \Stripe::setApiKey(Config::get('stripe.secret_key'));
        $user = Auth::guard('users') -> user();
        $optionsArray = array("name" => $user -> cashier_stripe_users_name, "email" => $user -> cashier_stripe_users_email, "description" => "Testing", "address" => array("city" => "Testing", "country" => "India", "line1" => "Testing Address", "line2" => "Testing Address", "postal_code" => "12345", "state" => "Chatisgarh"));
        $user->createOrGetStripeCustomer($optionsArray);
        $user->updateDefaultPaymentMethod($request -> payment_method);
        $user->charge($request -> price * 100, $request -> payment_method, ["currency" => "INR"]);
        return redirect()->route('restricted.product.index')->with("vmessage", "You have successfully purchased the product");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
    }
    
    
    
}
