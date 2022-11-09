<?php

namespace Dainsys\HumanResource\Database\Factories;

use Dainsys\HumanResource\Models\Position;
use Dainsys\HumanResource\Models\Department;
use Dainsys\HumanResource\Models\PaymentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'department_id' => Department::factory(),
            'payment_type_id' => PaymentType::factory(),
            'salary' => rand(80, 200),
            'description' => $this->faker->paragraph(),
        ];
    }
}
