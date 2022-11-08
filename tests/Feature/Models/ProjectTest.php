<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Project;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function projects_model_interacts_with_departments_table()
    {
        $data = Project::factory()->make();

        Project::create($data->toArray());

        $this->assertDatabaseHas(tableName('projects'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function projects_model_morph_one_information()
    // {
    //     $company = Project::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function projects_model_morph_many_images()
    // {
    //     $company = Project::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
