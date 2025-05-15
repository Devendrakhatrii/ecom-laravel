<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Products\ProductFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function create()
    {
        $cart = Auth::user()->cart;

        $orderItem = CartItem::with('product')->where('cart_id', $cart['cart_id'])->get();

        $order = $this->orderCreationHandler($orderItem);



        return view('order.order', ['order' => $order, 'payments' => $order['payments']]);
    }
    public function store(Request $request)
    {
        $orderItem = Auth::user()->cart->cartItems;
        $order = $this->orderCreationHandler($orderItem);

        $request->validate([
            'address' => ['required', 'string'],
            'payment_type' => ['required', Rule::in($order['payments'])]
        ]);

        $createdOrder = Order::create(['address' => $request->address, 'payment' => $request->payment_type, 'user_id' => Auth::id(), 'total_shipping' => $order['total_shipping'], 'total_discount' => $order['total_discount'], 'tax' => $order['tax'], 'total' => $order['grand_total']]);

        $order_id = $createdOrder->id;

        $orderItems = array_filter($order, 'is_int', ARRAY_FILTER_USE_KEY);

        if ($createdOrder) {
            foreach ($orderItems as $item) {
                OrderItem::create(['product_id' => $item['product']['product_id'], 'order_id' => $order_id, 'price' => $item['price'], 'quantity' => $item['quantity'], 'shipping' => $item['shipping'], 'discount' => $item['discount'], 'total' => $item['item_total']]);
            }

            Auth::user()->cart->cartItems()->pluck('id')->each(function ($id) {
                CartItem::destroy($id);
            });

            return redirect('/');
        }
    }

    public function orderCreationHandler($orderItem)
    {
        $factory = new ProductFactory();
        $orderPreview = [];
        $total = 0;
        $payments = [];
        $productTypes = [];
        $total_discount = 0;
        $total_shipping = 0;

        foreach ($orderItem as $item) {

            $product = $factory->createProduct($item['product']['type']);

            $discount = $product->getDisount($item['quantity'], $item['product']['price']);
            $shipping = $product->getShippingCharge($item['quantity']);

            $payments = array_unique(array_merge($payments, $product->getPaymentMethod()));

            $productTypes = array_unique(array_merge($productTypes, [$item['product']['type']]));




            $itemTotal = $item['quantity'] * $item['product']['price'] - $discount + $shipping;

            $total += $itemTotal;
            $total_discount += $discount;
            $total_shipping += $shipping;


            $orderPreview[] = [
                'cart_item' => $item,
                'product' => $item['product'],
                'quantity' => $item['quantity'],
                'price' => $item['product']['price'],
                'discount' => $discount,
                'shipping' => $shipping,
                'item_total' => $itemTotal,
            ];
        }

        $tax = $total * (13 / 100);
        $grandTotal = $total - $tax;



        if (in_array("digital", $productTypes) && in_array("physical", $productTypes)) {
            $payments = array_filter($payments, function ($key) {
                return $key !== "cash on delivery";
            });
        }

        return [...$orderPreview, 'grand_total' => $grandTotal, 'tax' => $tax, 'payments' => $payments, 'total_discount' => $total_discount, 'total_shipping' => $total_shipping];
    }
}
