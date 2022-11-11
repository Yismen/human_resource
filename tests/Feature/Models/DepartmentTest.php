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
    // public function departments_model_morph_one_information()
    // {
    //     $company = Department::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function departments_model_morph_many_images()
    // {
    //     $company = Department::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
