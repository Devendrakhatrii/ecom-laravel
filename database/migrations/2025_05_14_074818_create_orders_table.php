<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('orders');
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->string('address');
            $table->string('payment');
            $table->foreignIdFor(User::class, 'user_id')->constrained();
            $table->float('total_shipping');
            $table->float('total_discount');
            $table->float('tax');
            $table->float('total');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->foreignIdFor(Product::class, 'product_id');
            $table->foreignIdFor(Order::class, 'order_id');
            $table->float('price');
            $table->integer('quantity');
            $table->float('shipping');
            $table->float('discount');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
    }
};
