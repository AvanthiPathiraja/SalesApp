<?php

namespace Database\Factories;

use App\Models\IssueItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueItemFactory extends Factory
{

    protected $model = IssueItem::class;


    public function definition()
    {
        return [
                'issue_note_id' => $this->faker->numberBetween(1,500),
                'product_id' => $this->faker->numberBetween(1,1000),
                'stock_id' => $this->faker->numberBetween(1,3000),
                'quantity' => $this->faker->numberBetween(10,300)

        ];
    }
}
