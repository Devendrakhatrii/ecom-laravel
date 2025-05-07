<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cart_id',
        'address',
        'status',
        'payment_type',
        'total'
    ];

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    /** @use HasFactory<\Database\Factories\OrdersFactory> */
    use HasFactory;
}
