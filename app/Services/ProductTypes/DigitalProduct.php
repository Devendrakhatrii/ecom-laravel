<?php

namespace App\Services\ProductTypes;

use App\Models\Product;

class DigitalProduct extends Product implements AbstractProduct
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
        if ($this->quantity >= 12) {
            $total *= 0.8;
        } elseif ($this->quantity >= 6) {
            $total *= 0.9;
        }

        return $total;
    }

    public function getPaymentMethod(): array
    {
        return ['khalti'];
    }
}
