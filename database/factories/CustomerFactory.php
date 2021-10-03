<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{

    protected $model = Customer::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false),
            'name' => $this->faker->company,
            'contacted_person' => $this->faker->name,
            'telephone' => $this->faker->phoneNumber,
            'mobile' => $this->faker->phoneNumber,
            'route_id' => $this->faker->numberBetween(1,100),
            'address' => $this->faker->address,
            'email' => $this->faker->email,
        ];
    }
}
