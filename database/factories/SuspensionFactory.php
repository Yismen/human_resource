<?php

namespace Dainsys\HumanResource\Database\Factories;

use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Suspension;
use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SuspensionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Suspension::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'suspension_type_id' => SuspensionType::factory(),
            'starts_at' => now(),
            'ends_at' => now(),
            'comments' => $this->faker->paragraph(),
        ];
    }
}
