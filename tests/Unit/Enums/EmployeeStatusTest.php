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
            'Vacations',
            'Medical Leave',
            'Marriage',
            'Child Birth',
            'Family Death',
        ], $enums->values());
    }

    /** @test */
    public function all_method_return_associative_array()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\EmployeeStatus();

        $this->assertEquals([
            'Active' => 'Active',
            'Inactive' => 'Inactive',
            'Vacations' => 'Vacations',
            'Medical Leave' => 'Medical Leave',
            'Marriage' => 'Marriage',
            'Child Birth' => 'Child Birth',
            'Family Death' => 'Family Death',
        ], $enums->all());
    }
}
