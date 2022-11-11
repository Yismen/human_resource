<?php

namespace Dainsys\HumanResourceTests\Unit\Enums;

use PHPUnit\Framework\TestCase;

class GenderTest extends TestCase
{
    /** @test */
    public function values_method_return_specific_values()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\Gender();

        $this->assertEquals([
            'Male',
            'Female',
            'Undefined',
        ], $enums->values());
    }

    /** @test */
    public function all_method_return_associative_array()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\Gender();

        $this->assertEquals([
            'Male' => 'Male',
            'Female' => 'Female',
            'Undefined' => 'Undefined',
        ], $enums->all());
    }
}
