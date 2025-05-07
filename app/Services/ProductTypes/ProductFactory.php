<?php

namespace App\Services\ProductTypes;

use App\Services\ProductTypes\DigitalProduct;
use App\Services\ProductTypes\PhysicalProduct;

use InvalidArgumentException;

class ProductFactory
{
    public static function create(array $item)
    {
        $type = strtolower($item['types'] ?? '');
        $unitPrice = $item['price'] ?? 0;
        $quantity = $item['quantity'] ?? 0;

        return match (strtolower($type)) {
            'digital' => new DigitalProduct($quantity, $unitPrice),
            'physical' => new PhysicalProduct($quantity, $unitPrice),
            default => throw new InvalidArgumentException("Invalid type {$type}")
        };
    }
}
