<?php

namespace Database\Factories;

use App\Models\DiscardedStock;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscardedStockFactory extends Factory
{

    protected $model = DiscardedStock::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date ,
            'employee_id' => $this->faker->numberBetween(1,100) ,
            'stock_id' => $this->faker->numberBetween(1,1000) ,
            'quantity' => $this->faker->numberBetween(1,50) ,
            'reason' => $this->faker->word

        ];
    }
}
