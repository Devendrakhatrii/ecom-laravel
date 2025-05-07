<?php

namespace App\Services\ProductTypes;

interface AbstractProduct
{
    public function calculateTotal(): float;
    public function getPaymentMethod(): array;
}
