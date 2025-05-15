<?php

namespace App\Products;

use App\Products\ProductInterface;

class DigitalProduct implements ProductInterface
{

    public static function getDisount(int $orderQuantity, float $productPrice): float|int
    {
        $total = $orderQuantity * $productPrice;

        if ($orderQuantity >= 6 && $orderQuantity < 12) {

            $discountPercentage = 10;

            return $total * ($discountPercentage / 100);
        }

        if ($orderQuantity >= 12) {

            $discountPercentage = 20;

            return $total * ($discountPercentage / 100);
        }

        return 0;
    }

    public static  function getShippingCharge(int $quantity): float|int
    {
        return 0;
    }

    public static function getPaymentMethod(): array
    {
        return ["Khalti"];
    }
}
