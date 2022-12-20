<?php

namespace Dainsys\HumanResource\Tests\Feature\Models;

use Illuminate\Support\Facades\Mail;
use Dainsys\HumanResource\Models\Afp;
use Dainsys\HumanResource\Models\Ars;
use Dainsys\HumanResource\Models\Bank;
use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Tests\TestCase;
use Dainsys\HumanResource\Models\Employee;
use Dainsys\HumanResource\Models\Supervisor;
use Dainsys\HumanResource\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InformationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sites_model_interacts_with_db_table()
    {
        $data = Information::factory()->create();

        $this->assertDatabaseHas(tableName('informations'), $data->only([
            'phone', 'email', 'photo_url', 'address', 'company_id', 'informationable_id', 'informationable_type'
        ]));
    }

    /** @test */
    public function information_model_morph_employee()
    {
        Mail::fake();
        $employee = Employee::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $employee->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($employee->information);
        $this->assertInstanceOf(MorphOne::class, $employee->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->employee());
    }

    /** @test */
    public function information_model_morph_site()
    {
        $site = Site::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $site->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($site->information);
        $this->assertInstanceOf(MorphOne::class, $site->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->site());
    }

    /** @test */
    public function information_model_morph_bank()
    {
        $bank = Bank::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $bank->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($bank->information);
        $this->assertInstanceOf(MorphOne::class, $bank->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->bank());
    }

    /** @test */
    public function information_model_morph_ars()
    {
        $ars = Ars::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $ars->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($ars->information);
        $this->assertInstanceOf(MorphOne::class, $ars->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->ars());
    }

    /** @test */
    public function information_model_morph_afp()
    {
        $afp = Afp::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $afp->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($afp->information);
        $this->assertInstanceOf(MorphOne::class, $afp->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->afp());
    }

    /** @test */
    public function information_model_morph_supervisor()
    {
        $supervisor = Supervisor::factory()->create();
        $data = [
            'phone' => 'phone',
            'email' => 'email',
            'photo_url' => 'photo',
            'address' => 'address',
            'company_id' => 'asdfasdf',
        ];

        $supervisor->information()->create($data);

        $this->assertDatabaseHas(tableName('informations'), $data);
        $this->assertNotNull($supervisor->information);
        $this->assertInstanceOf(MorphOne::class, $supervisor->information());
        $this->assertInstanceOf(BelongsTo::class, (new Information())->supervisor());
    }
}
