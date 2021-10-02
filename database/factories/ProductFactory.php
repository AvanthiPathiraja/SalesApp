<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    protected $model = Product::class;


    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false) ,
            'category' => $this->faker->word,
            'name' => $this->faker->word,
            'metric' => $this->faker->randomLetter,
            'size' => $this->faker->numberBetween(1,10000) ,
            'minimum_stock' => $this->faker->numberBetween(20,5000),
            'unit_price' => $this->faker->numberBetween(100,5000)

        ];
    }
}
