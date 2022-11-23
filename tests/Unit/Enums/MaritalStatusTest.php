<?php

namespace Dainsys\HumanResourceTests\Unit\Enums;

use PHPUnit\Framework\TestCase;
use Dainsys\HumanResource\Support\Enums\MaritalStatus;

class MaritalStatusTest extends TestCase
{
    /** @test */
    public function values_method_return_specific_values()
    {
        $this->assertEquals([
            'Single',
            'Married',
            'Divorced',
            'Free Union',
        ], MaritalStatus::values());
    }

    /** @test */
    public function all_method_return_associative_array()
    {
        $this->assertEquals([
            'Single' => 'Single',
            'Married' => 'Married',
            'Divorced' => 'Divorced',
            'Free Union' => 'Free Union',
        ], MaritalStatus::all());
    }
}
