<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\OrderItem;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = ['address', 'payment', 'user_id', 'total_discount', 'total_shipping', 'tax', 'total'];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
