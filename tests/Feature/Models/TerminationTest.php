<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Events\TerminationCreated;

class TerminationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function terminations_model_interacts_with_db_table()
    {
        $data = Termination::factory()->make();

        Termination::create($data->toArray());

        $this->assertDatabaseHas(tableName('terminations'), $data->only([
            'employee_id', 'date', 'termination_type_id', 'termination_reason_id', 'comments', 'rehireable'
        ]));
    }

    /** @test */
    public function termination_model_fires_event_when_created()
    {
        Event::fake();
        $termination = Termination::factory()->create();

        Event::assertDispatched(TerminationCreated::class);
    }

    /** @test */
    public function terminations_model_belongs_to_employee()
    {
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->employee());
    }

    /** @test */
    public function terminations_model_belongs_to_terminationType()
    {
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->terminationType());
    }

    /** @test */
    public function terminations_model_belongs_to_terminationReason()
    {
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->terminationReason());
    }
}
