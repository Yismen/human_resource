<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Events\SuspensionCreated;

class SuspensionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspensions_model_interacts_with_db_table()
    {
        $data = Suspension::factory()->make();

        Suspension::create($data->toArray());

        $this->assertDatabaseHas(tableName('suspensions'), $data->only([
            'employee_id', 'suspension_type_id', 'comments'
        ]));
    }

    /** @test */
    public function suspension_model_fires_event_when_created()
    {
        Event::fake();
        $suspension = Suspension::factory()->create();

        Event::assertDispatched(SuspensionCreated::class);
    }

    /** @test */
    public function suspensions_model_belongs_to_employee()
    {
        $suspension = Suspension::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $suspension->employee());
    }

    /** @test */
    public function suspensions_model_belongs_to_suspensionType()
    {
        $suspension = Suspension::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $suspension->suspensionType());
    }
}
