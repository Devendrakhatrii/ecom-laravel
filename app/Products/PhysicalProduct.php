<?php

namespace App\Products;

use App\Products\ProductInterface;

class PhysicalProduct implements ProductInterface
{

    public static function getDisount(int $orderQuantity, float $productPrice): float|int
    {
        return 0;
    }

    public static function getShippingCharge(int $quantity): float|int
    {
        if ($quantity >= 5 && $quantity < 10) {
            return 100;
        }

        if ($quantity >= 10) {
            return 200;
        }

        return 0;
    }

    public static function getPaymentMethod(): array
    {
        return ["esewa", "cash on delivery"];
    }
}
