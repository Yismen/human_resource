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
    // public function supervisors_model_morph_one_information()
    // {
    //     $company = Supervisor::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function supervisors_model_morph_many_images()
    // {
    //     $company = Supervisor::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
