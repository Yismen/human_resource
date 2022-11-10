<?php

namespace Dainsys\HumanResource\Database\Factories;

use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Termination;
use Dainsys\HumanResource\Models\TerminationType;
use Dainsys\HumanResource\Models\TerminationReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class TerminationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Termination::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => Employee::factory(),
            'date' => now(),
            'termination_type_id' => TerminationType::factory(),
            'termination_reason_id' => TerminationReason::factory(),
            'rehireable' => $this->faker->randomElement([0, 1]),
            'comments' => $this->faker->paragraph(),
        ];
    }
}
