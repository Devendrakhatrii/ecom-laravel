<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    /** @use HasFactory<\Database\Factories\OrderItemFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'quantity',
        'shipping',
        'discount',
        'total',
    ];


    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
