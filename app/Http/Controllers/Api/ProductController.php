<?php

namespace App\Http\Controllers\Api;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    use ApiResponse;

    public function index(): JsonResponse
    {
        try {
            $products = Product::all();
            return $this->success($products, 'Products retrieved successfully');
        } catch (Exception $e) {
            return $this->fails('Failed to fetch products', 500, $e->getMessage());
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            return $this->success($product, 'Product retrieved successfully');
        } catch (Exception $e) {
            return $this->fails('Product not found', 404, $e->getMessage());
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $product = Product::create([
                ...$request->validated(),
                'user_id' => Auth::id()
            ]);

            return $this->success($product, 'Product created successfully', 201);
        } catch (Exception $e) {
            return $this->fails('Failed to create product', 500, $e->getMessage());
        }
    }

    public function update(string $id, UpdateProductRequest $request): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);
            $updated = $product->update($request->validated());

            if (!$updated) {
                return $this->fails('Failed to update product', 400, 'Update operation failed');
            }

            return $this->success($product->fresh(), 'Product updated successfully');
        } catch (Exception $e) {
            return $this->fails('Failed to update product', 403, $e->getMessage());
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            if (Auth::id() !== $product->user_id) {
                return $this->fails('You are not authorized to delete this product', 403, 'Unauthorized access');
            }

            $product->delete();
            return $this->success(null, 'Product deleted successfully');
        } catch (Exception $e) {
            return $this->fails('Failed to delete product', 403, $e->getMessage());
        }
    }

    public function reduceQuantity(){
        
    }
}
