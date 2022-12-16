<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Termination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Events\TerminationCreated;
use Dainsys\HumanResource\Mail\TerminationCreated as MailTerminationCreated;

class TerminationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function terminations_model_interacts_with_db_table()
    {
        Mail::fake();
        $data = Termination::factory()->make();

        Termination::create($data->toArray());

        $this->assertDatabaseHas(tableName('terminations'), $data->only([
            'employee_id', 'termination_type_id', 'termination_reason_id', 'comments', 'rehireable'
        ]));
    }

    /** @test */
    public function termination_model_fires_event_when_created()
    {
        Mail::fake();
        Event::fake();
        $termination = Termination::factory()->create();

        Event::assertDispatched(TerminationCreated::class);
    }

    /** @test */
    public function email_is_sent_when_termination_is_created()
    {
        Mail::fake();
        Termination::factory()->create();

        Mail::assertQueued(MailTerminationCreated::class);
    }

    /** @test */
    public function terminations_model_belongs_to_employee()
    {
        Mail::fake();
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->employee());
    }

    /** @test */
    public function terminations_model_belongs_to_terminationType()
    {
        Mail::fake();
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->terminationType());
    }

    /** @test */
    public function terminations_model_belongs_to_terminationReason()
    {
        Mail::fake();
        $termination = Termination::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $termination->terminationReason());
    }
}
