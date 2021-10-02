<?php

namespace Database\Factories;

use App\Models\InvoiceReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceReturnFactory extends Factory
{

    protected $model = InvoiceReturn::class;


    public function definition()
    {
        return [
            'invoice_id' => $this->faker->numberBetween(1,50) ,
            'invoice_item_id' => $this->faker->numberBetween(1,500) ,
            'date' => $this->faker->date,
            'distributor_id' => $this->faker->numberBetween(1,100) ,
            'stock_id' => $this->faker->numberBetween(1,1000),
            'quantity' => $this->faker->numberBetween(1,20) ,
            'reason' => $this->faker->word

        ];
    }
}
