<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Products\ProductFactory;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function __construct(private $orderService = new OrderService) {}

    public function create()
    {
        $order = $this->orderService->create();

        return view('order.order', $order);
    }

    public function store(Request $request)
    {
        $created = $this->orderService->store($request);

        if ($created) {
            return back();
        }
    }
}
