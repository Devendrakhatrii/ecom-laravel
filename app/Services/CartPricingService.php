<?php

namespace App\Services;

use App\Services\ProductTypes\ProductFactory;

class CartPricingService
{
    public static function calculate(array $cartItems): array
    {
        $total = 0;
        $productType = [];
        $paymentMethods = [];


        foreach ($cartItems as &$item) {
            $productData = $item['product'];

            $productData['quantity']  = $item['quantity'];
            $product = ProductFactory::create($productData);
            $item['total'] = $product->calculateTotal();
            $paymentMethods = array_unique(array_merge($paymentMethods, $product->getPaymentMethod()));
            $total += $item['total'];
            $productType[] = $item['product']['types'];
        }
        $productType = array_unique($productType);

        if (in_array("digital", $productType) && in_array("physical", $productType)) {
            $paymentMethods = array_filter($paymentMethods, fn($method) => $method !== 'COD');
            $paymentMethods = array_values($paymentMethods);
        }

        $tax = $total * 0.13;
        $grandTotal = $total + $tax;

        return [
            'cartItems' => $cartItems,
            'total' => $total,
            'tax' => $tax,
            'grandTotal' => $grandTotal,
            'paymentMethods' => $paymentMethods
        ];
    }
}
