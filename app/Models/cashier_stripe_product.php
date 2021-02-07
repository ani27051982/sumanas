<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cashier_stripe_product extends Model
{
   protected $table='cashier_stripe_products';
   public $timestamps = false; 
    
    protected $fillable = [
        'name','price'
    ];
    
    protected $primaryKey = 'cashier_stripe_products_id';
}
