<?php

namespace Database\Factories;

use App\Models\InvoicePayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoicePaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InvoicePayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false),
            'reference' => $this->faker->randomNumber(null,false),
            'date' => $this->faker->date,
            'customer_id' => $this->faker->numberBetween(1,1000),
            'payment_type' => $this->faker->word,
            'amount' => $this->faker->numberBetween(500,20000),
            'note' => $this->faker->word,
       ];
    }
}
