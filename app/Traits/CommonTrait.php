<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Traits;

use Illuminate\Http\Request;
use Response;
use \Illuminate\Http\Response as Res;
use App\Models\cashier_stripe_product;

/**
 * Description of CommonTrait
 *
 * @author Admin
 */
trait CommonTrait {
    private $getAllProducts;
        
    public function getAllProducts() {
        $getAllProducts = cashier_stripe_product :: all();
        return $getAllProducts;
    }
    
    
    
}
