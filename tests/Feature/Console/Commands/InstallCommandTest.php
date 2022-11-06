<?php

namespace Dainsys\HumanResource\Tests\Feature\Console\Commands;

use Dainsys\HumanResource\Models\Site;
use Dainsys\HumanResource\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\HumanResource\Console\Commands\InstallCommand;

class InstallCommandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function install_command_creates_site()
    {

        $this->artisan(InstallCommand::class)
            ->assertSuccessful();
    }
}
