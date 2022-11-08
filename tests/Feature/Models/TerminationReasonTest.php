<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Models\TerminationReason;

class TerminationReasonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_reasons_model_interacts_with_departments_table()
    {
        $data = TerminationReason::factory()->make();

        TerminationReason::create($data->toArray());

        $this->assertDatabaseHas(tableName('termination_reasons'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function termination_reasons_model_morph_one_information()
    // {
    //     $company = TerminationReason::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function termination_reasons_model_morph_many_images()
    // {
    //     $company = TerminationReason::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
