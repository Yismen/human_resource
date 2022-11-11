<?php

namespace Dainsys\HumanResource\Database\Factories;

use Illuminate\Support\Str;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Information;
use Illuminate\Database\Eloquent\Factories\Factory;

class InformationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Information::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'photo_url' => $this->faker->url(),
            'address' => $this->faker->address(),
            'company_id' => Str::random(10),
            'informationable_id' => 1,
            'informationable_type' => Employee::class,
        ];
    }
}
