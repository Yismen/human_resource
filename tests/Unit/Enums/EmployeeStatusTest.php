<?php

namespace Dainsys\HumanResourceTests\Unit\Enums;

use PHPUnit\Framework\TestCase;

class EmployeeStatusTest extends TestCase
{
    /** @test */
    public function values_method_return_specific_values()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\EmployeeStatus();

        $this->assertEquals([
            'Active',
            'Inactive',
            'Suspended',
        ], $enums->values());
    }

    /** @test */
    public function all_method_return_associative_array()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\EmployeeStatus();

        $this->assertEquals([
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'Suspended' => 'Suspended',
        ], $enums->all());
    }
}
