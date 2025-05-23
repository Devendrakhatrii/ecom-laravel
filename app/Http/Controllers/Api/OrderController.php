<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    use ApiResponse;

    public function __construct(private $orderService = new OrderService) {}

    public function index(Request $request)
    {
        try {
            $query = Auth::user()->orders()->with('orderItems.product');

            if ($request->has('status')) {
                $query->where('status', $request->query('status'));
            }

            $order = $query->get();
            if (!$order) {
                return $this->fails('unable to get the orders');
            }

            return $this->success($order, 'orders fetched succesfully');
        } catch (Exception $e) {
            return $this->fails('unable to get the orders', 400, $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {

            $order = $this->orderService->store($request);

            if (!$order) {
                return $this->fails('unable to create order');
            }
            return $this->success('order created succesfully');
        } catch (Exception $e) {
            return $this->fails(
                'unable to get the orders',
                400,
                $e->getMessage()
            );
        }
    }
}
