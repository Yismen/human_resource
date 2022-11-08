<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitizenshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function citizenships_model_interacts_with_departments_table()
    {
        $data = Citizenship::factory()->make();

        Citizenship::create($data->toArray());

        $this->assertDatabaseHas(tableName('citizenships'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function citizenships_model_morph_one_information()
    // {
    //     $company = Citizenship::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function citizenships_model_morph_many_images()
    // {
    //     $company = Citizenship::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
