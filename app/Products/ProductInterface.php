<?php

namespace App\Products;


interface ProductInterface
{
    public static function getDisount(int $orderQuantity, float $productPrice): float|int;
    public static function getShippingCharge(int $quantity): float|int;
    public static function getPaymentMethod(): array;
}
