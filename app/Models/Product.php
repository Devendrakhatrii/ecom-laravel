<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'price',
        'user_id',
        'types',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart_item()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
}
