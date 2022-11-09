<?php

namespace Dainsys\HumanResourceTests\Unit\Enums;

use PHPUnit\Framework\TestCase;

class MaritalStatusTest extends TestCase
{
    /** @test */
    public function values_method_return_specific_values()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\MaritalStatus();

        $this->assertEquals([
            'Single',
            'Married',
            'Divorced',
            'Free Union',
        ], $enums->values());
    }

    /** @test */
    public function all_method_return_associative_array()
    {
        $enums = new \Dainsys\HumanResource\Support\Enums\MaritalStatus();

        $this->assertEquals([
            'Single' => 'Single',
            'Married' => 'Married',
            'Divorced' => 'Divorced',
            'Free Union' => 'Free Union',
        ], $enums->all());
    }
}
