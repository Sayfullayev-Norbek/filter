<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'discount_percent' => $this->faker->randomElement([0, 5, 10, 15, 20]),
            'discount_price' => function (array $attributes) {
                if ($attributes['discount_percent'] > 0) {
                    $discountAmount = ($attributes['price'] * $attributes['discount_percent']) / 100;
                    return $attributes['price'] - $discountAmount;
                }
                return null;
            },
            'amount' => $this->faker->numberBetween(1, 100),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
