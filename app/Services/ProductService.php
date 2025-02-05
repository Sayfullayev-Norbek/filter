<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    public function dashboard($request)
    {
        return Product::query()
            ->when($request->filled('month'), fn($q) => $q->whereMonth('created_at', $request->input('month')))
            ->when($request->filled('year'), fn($q) => $q->whereYear('created_at', $request->input('year')))
            ->when($request->filled('name'), fn($q) => $q->where('name', 'like', "%{$request->input('name')}%"))
            ->when($request->filled('type'), fn($q) => $q->where('type', $request->input('type')))
            ->when($request->filled('day'), function ($q) use ($request) {
                $date = \DateTime::createFromFormat('d.m', $request->input('day'));
                if ($date) {
                    $q->whereDate('created_at', $date->format('Y-m-d'));
                }
            })
            ->get();
    }

    /**
     * @param $request
     * @return Builder|Model
     */
    public function store($request): Builder|Model
    {
        return Product::query()->create([
            'user_id' => auth()->id(),
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'amount' => $request->input('amount'),
            'discount_percent' => $request->input('discount_percent'),
        ]);
    }

    public function update($request, Product $product): Builder|Model
    {
        $product = Product::query()
            ->where('user_id', auth()->id())
            ->where('id', $product->id)
            ->firstOrFail();

        $product->update([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'price' => $request->input('price'),
            'amount' => $request->input('amount'),
            'discount_percent' => $request->input('discount_percent'),
        ]);

        return $product;
    }
}
