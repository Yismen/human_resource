<?php

namespace Dainsys\HumanResource\Database\Factories;

use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerminationTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TerminationType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'description' => $this->faker->email(),
        ];
    }
}
