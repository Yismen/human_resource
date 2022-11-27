<?php

namespace Dainsys\HumanResource\Database\Factories;

use Carbon\Carbon;
use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Models\Project;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Position;
use Dainsys\HumanResource\Models\Supervisor;
use Dainsys\HumanResource\Models\Citizenship;
use Dainsys\HumanResource\Support\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Dainsys\HumanResource\Support\Enums\MaritalStatus;
use Dainsys\HumanResource\Support\Enums\EmployeeStatus;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'second_first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'second_last_name' => $this->faker->lastName(),
            'full_name' => $this->faker->name(),
            'personal_id' => rand(10000000000, 99999999999),
            'hired_at' => now(),
            'date_of_birth' => Carbon::parse(),
            'cellphone' => $this->faker->phoneNumber(),
            'status' => array_rand(EmployeeStatus::all()),
            'marriage' => array_rand(MaritalStatus::all()),
            'gender' => array_rand(Gender::all()),
            'kids' => $this->faker->randomElement([0, 1]),
            'site_id' => Site::factory(),
            'project_id' => Project::factory(),
            'position_id' => Position::factory(),
            'citizenship_id' => Citizenship::factory(),
            'supervisor_id' => Supervisor::factory(),
            'afp_id' => Afp::factory(),
            'ars_id' => Ars::factory(),
        ];
    }

    public function current(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => EmployeeStatus::CURRENT,
            ];
        });
    }

    public function inactive(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => EmployeeStatus::INACTIVE,
            ];
        });
    }

    public function suspended(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => EmployeeStatus::SUSPENDED,
            ];
        });
    }
}
