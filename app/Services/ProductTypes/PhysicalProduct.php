<?php

namespace App\Services\ProductTypes;

use App\Models\Product;

class PhysicalProduct extends Product implements AbstractProduct
{

    private $quantity;
    private $price;

    public function __construct($quantity, $price)
    {
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function calculateTotal(): float
    {
        $total = $this->quantity * $this->price;
        if ($this->quantity >= 10) {
            $total += 200;
        } elseif ($this->quantity >= 5) {
            $total += 100;
        }

        return $total;
    }

    public function getPaymentMethod(): array
    {
        return ['khalti'];
    }
}
