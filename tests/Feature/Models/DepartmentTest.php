<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function departments_model_interacts_with_db_table()
    {
        $data = Department::factory()->make();

        Department::create($data->toArray());

        $this->assertDatabaseHas(tableName('departments'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function departments_model_has_many_positions()
    {
        $department = Department::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $department->positions());
    }

    /** @test */
    public function departments_model_has_many_employees()
    {
        $department = Department::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasManyThrough::class, $department->employees());
    }
}
