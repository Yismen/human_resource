<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Project;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function projects_model_interacts_with_db_table()
    {
        $data = Project::factory()->make();

        Project::create($data->toArray());

        $this->assertDatabaseHas(tableName('projects'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function projects_model_has_many_employees()
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $project->employees());
    }
}
