<?php

namespace Database\Factories;

use App\Models\IssueNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueNoteFactory extends Factory
{

    protected $model = IssueNote::class;

    public function definition()
    {
        return [
            'number' => $this->faker->randomNumber(null,false),
            'reference' => $this->faker->randomNumber(null,false),
            'date' => $this->faker->date,
            'distributor_id' => $this->faker->numberBetween(1,100),
        ];
    }
}
