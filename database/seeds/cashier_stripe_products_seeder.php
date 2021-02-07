<?php

use Illuminate\Database\Seeder;
use App\Models\cashier_stripe_product;

class cashier_stripe_products_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productData = [
            [
                'name'=>"Testing Product 1",
                'price' => "10.00"
            ],
            [
                'name'=>"Testing Product 2",
                'price' => "15.00"
            ],
            [
                'name'=>"Testing Product 3",
                'price' => "20.00"
            ],
            [
                'name'=>"Testing Product 4",
                'price' => "25.00"
            ]
        ];
        foreach ($productData as $productDatas) {
            cashier_stripe_product::create($productDatas);
        }
    }
}
