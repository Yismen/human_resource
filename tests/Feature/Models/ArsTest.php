<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function arss_model_interacts_with_db_table()
    {
        $data = Ars::factory()->make();

        Ars::create($data->toArray());

        $this->assertDatabaseHas(tableName('arss'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function arss_model_morph_one_information()
    {
        $ars = Ars::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $ars->information());
    }

    /** @test */
    public function arss_model_has_many_employees()
    {
        $ars = Ars::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $ars->employees());
    }
}
