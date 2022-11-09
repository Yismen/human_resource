<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AfpTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function afps_model_interacts_with_db_table()
    {
        $data = Afp::factory()->make();

        Afp::create($data->toArray());

        $this->assertDatabaseHas(tableName('afps'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function afps_model_morph_one_information()
    // {
    //     $company = Afp::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function afps_model_morph_many_images()
    // {
    //     $company = Afp::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
