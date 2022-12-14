<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Citizenship;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitizenshipTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function citizenships_model_interacts_with_db_table()
    {
        $data = Citizenship::factory()->make();

        Citizenship::create($data->toArray());

        $this->assertDatabaseHas(tableName('citizenships'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function citizenships_model_has_many_employees()
    {
        $citizenship = Citizenship::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $citizenship->employees());
    }
}
