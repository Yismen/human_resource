<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function position_model_interacts_with_positions_table()
    {
        $data = Position::factory()->make();

        Position::create($data->toArray());

        $this->assertDatabaseHas(tableName('positions'), $data->only([
            'name',
            'department_id',
            'payment_type_id',
            // 'salary',
            'description',
        ]));
    }

    /** @test */
    public function positions_model_has_many_employees()
    {
        $position = Position::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $position->employees());
    }

    /** @test */
    public function positions_model_belongs_to_department()
    {
        $position = Position::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $position->department());
    }

    /** @test */
    public function positions_model_belongs_to_paymentType()
    {
        $position = Position::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\BelongsTo::class, $position->paymentType());
    }
}
