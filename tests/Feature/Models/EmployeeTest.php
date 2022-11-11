<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function employee_model_interacts_with_employees_table()
    {
        $data = Employee::factory()->make();

        Employee::create($data->toArray());

        $this->assertDatabaseHas(tableName('employees'), $data->only([
            'first_name',
            'second_firt_name',
            'last_name',
            'second_last_name',
            'personal_id',
            'full_name',
            'hired_at',
            'date_of_birth',
            'cellphone',
            'status',
            'marriage',
            'gender',
            'kids',
        ]));
    }

    /** @test */
    // public function employees_model_morph_one_information()
    // {
    //     $company = Employee::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function employees_model_morph_many_images()
    // {
    //     $company = Employee::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
