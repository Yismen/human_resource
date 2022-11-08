<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\TerminationType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TerminationTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function termination_types_model_interacts_with_departments_table()
    {
        $data = TerminationType::factory()->make();

        TerminationType::create($data->toArray());

        $this->assertDatabaseHas(tableName('termination_types'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function termination_types_model_morph_one_information()
    // {
    //     $company = TerminationType::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function termination_types_model_morph_many_images()
    // {
    //     $company = TerminationType::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
