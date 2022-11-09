<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sites_model_interacts_with_db_table()
    {
        $data = Site::factory()->make();

        Site::create($data->toArray());

        $this->assertDatabaseHas(tableName('sites'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    // public function sites_model_morph_one_information()
    // {
    //     $company = Site::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $company->information());
    // }

    // /** @test */
    // public function sites_model_morph_many_images()
    // {
    //     $company = Site::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
