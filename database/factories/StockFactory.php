<?php

namespace Database\Factories;

use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{

    protected $model = Stock::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false),
            'date' => $this->faker->date,
            'product_id' => $this->faker->numberBetween(1,2000),
            'unit_price' => $this->faker->numberBetween(100,5000),
            'unit_cost' => $this->faker->numberBetween(500,4000),
            'quantity' => $this->faker->numberBetween(100,50000),
            'expire_date' => $this->faker->date,
        ];
    }
}
