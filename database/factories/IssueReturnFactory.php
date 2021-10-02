<?php

namespace Database\Factories;

use App\Models\IssueReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueReturnFactory extends Factory
{

    protected $model = IssueReturn::class;

    public function definition()
    {
        return [
            'date' => $this->faker->date,
            'distributor_id' => $this->faker->numberBetween(1,100) ,
            'issue_item_id' => $this->faker->numberBetween(1,1000) ,
            'stock_id' => $this->faker->numberBetween(1,1000) ,
            'quantity' => $this->faker->numberBetween(1,500) ,
            'reason' => $this->faker->word

        ];
    }
}
