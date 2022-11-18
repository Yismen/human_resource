<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Dainsys\HumanResource\Models\Bank;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function banks_model_interacts_with_db_table()
    {
        $data = Bank::factory()->make();

        Bank::create($data->toArray());

        $this->assertDatabaseHas(tableName('banks'), $data->only([
            'name', 'description'
        ]));
    }

    /** @test */
    public function banks_model_morph_one_information()
    {
        $bank = Bank::factory()->create();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphOne::class, $bank->information());
    }

    // /** @test */
    // public function banks_model_morph_many_images()
    // {
    //     $company = Bank::factory()->create();

    //     $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\MorphMany::class, $company->images());
    // }
}
