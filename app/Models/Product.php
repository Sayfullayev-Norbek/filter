<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'discount_price',
        'discount_percent',
        'amount',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::saving(function ($product) {
            if ($product->discount_percent) {
                $discountAmount = ($product->price * $product->discount_percent) / 100;
                $product->discount_price = $product->price - $discountAmount;
            }
        });
    }
}
