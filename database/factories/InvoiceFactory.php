<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{

    protected $model = Invoice::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false),
            'reference' => $this->faker->randomNumber(null,false),
            'date' => $this->faker->date,
            'customer_id' => $this->faker->numberBetween(1,1000),
            'distributor_id' => $this->faker->numberBetween(1,100),
            'total_price' => $this->faker->numberBetween(1000,90000),
            'total_discount' => $this->faker->numberBetween(500,8000),
        ];
    }
}
