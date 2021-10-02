<?php

namespace Database\Factories;

use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceItemFactory extends Factory
{

    protected $model = InvoiceItem::class;


    public function definition()
    {
        return [
            'invoice_id' => $this->faker->numberBetween(1,1000),
            'issue_item_id' => $this->faker->numberBetween(1,3000),
            'stock_id' => $this->faker->numberBetween(1,1000),
            'unit_price' => $this->faker->numberBetween(10,2000),
            'unit_discount' => $this->faker->numberBetween(1,500),
            'quantity' => $this->faker->numberBetween(1,2000),
        ];
    }
}
