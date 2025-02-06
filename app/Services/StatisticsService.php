<?php

namespace App\Services;

use App\Models\Product;

class StatisticsService
{
    /**
     * @param $filters
     * @return array
     */
    public function getStatistics($filters): array
    {
        $query = Product::query();

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['year']) && !empty($filters['month'])) {
            $query->whereYear('created_at', $filters['year'])
                ->whereMonth('created_at', $filters['month']);
        } elseif (!empty($filters['year'])) {
            $query->whereYear('created_at', $filters['year']);
        } elseif (!empty($filters['month'])) {
            $query->whereMonth('created_at', $filters['month']);
        }

        return [
            'total_products' => $query->count(),
            'total_price' => $query->sum('price'),
            'total_discount_price' => $query->sum('discount_price'),
            'total_amount' => $query->sum('amount'),
        ];
    }
}
