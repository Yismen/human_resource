<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Suspension;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuspensionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspensions_model_interacts_with_db_table()
    {
        $data = Suspension::factory()->make();

        Suspension::create($data->toArray());

        $this->assertDatabaseHas(tableName('suspensions'), $data->only([
            'employee_id', 'suspension_type_id', 'starts_at', 'ends_at', 'comments'
        ]));
    }

    /** @test */
    // public function suspensions_model_morph_one_information()
    // {
    //     $company = Suspension::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function suspensions_model_morph_many_images()
    // {
    //     $company = Suspension::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
