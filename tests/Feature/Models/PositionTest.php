<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
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
            'salary',
            'description',
        ]));
    }

    /** @test */
    // public function positions_model_morph_one_information()
    // {
    //     $company = Position::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function positions_model_morph_many_images()
    // {
    //     $company = Position::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
