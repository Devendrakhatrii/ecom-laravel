<?php


namespace App\Products;

use App\Products\PhysicalProduct;
use App\Products\DigitalProduct;


class ProductFactory
{


    public function createProduct($type)
    {
        return match ($type) {
            'physical' => new PhysicalProduct(),
            'digital' =>  new DigitalProduct(),
        };
    }
}
