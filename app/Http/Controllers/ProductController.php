<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService  $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function dashboard(Request $request): JsonResponse
    {
        try {

            $products = $this->productService->dashboard($request);

            $totalSum = $products->sum(function($product) {
                return $product->price;
            });

            return $this->response([
                'data' => ProductResource::collection($products),
                'total_sum' => number_format($totalSum, 2),
            ]);
        }catch (Exception $exception){
            return $this->error($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $this->authorize('create', Product::class);

            return $this->success(
                'Mahsulot yaratildi',
                new ProductResource($this->productService->store($request))
            );
        }catch (Exception $exception){
            return $this->error($exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        try {
            return $this->success(
                'Mahsulot yangilandi',
                new ProductResource($this->productService->update($request, $product))
            );
        }catch (Exception $exception){
            return $this->error($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        return response()->json(['message' => 'Mahsulot o‘chirildi']);
    }
}
