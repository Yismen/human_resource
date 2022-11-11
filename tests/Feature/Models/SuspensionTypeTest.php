<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\SuspensionType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuspensionTypeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function suspension_types_model_interacts_with_db_table()
    {
        $data = SuspensionType::factory()->make();

        SuspensionType::create($data->toArray());

        $this->assertDatabaseHas(tableName('suspension_types'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function suspension_types_model_morph_one_information()
    // {
    //     $company = SuspensionType::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function suspension_types_model_morph_many_images()
    // {
    //     $company = SuspensionType::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
