<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{

    protected $model = Employee::class;


    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false) ,
            'title' => $this->faker->title,
            'first_name' => $this->faker->firstName(100),
            'last_name' => $this->faker->lastName(100),
            'date_of_birth' => $this->faker->date,
            'nic_number' => $this->faker->numerify('##########'),
            'driving_lisence_number' => $this->faker->numerify('##########'),
            'telephone' => $this->faker->phoneNumber(10),
            'mobile' => $this->faker->phoneNumber(10),
            'address' => $this->faker->address(255),
            'email' => $this->faker->email(100),
            'designation' => $this->faker->jobTitle(20)
        ];
    }
}
