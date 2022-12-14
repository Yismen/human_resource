<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Supervisor;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupervisorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function supervisors_model_interacts_with_db_table()
    {
        $data = Supervisor::factory()->make();

        Supervisor::create($data->toArray());

        $this->assertDatabaseHas(tableName('supervisors'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function supervisors_model_morph_one_information()
    {
        $supervisor = Supervisor::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $supervisor->information());
    }

    /** @test */
    public function supervisors_model_has_many_employees()
    {
        $supervisor = Supervisor::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $supervisor->employees());
    }
}
