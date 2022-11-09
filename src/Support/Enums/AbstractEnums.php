<?php

namespace Dainsys\HumanResource\Support\Enums;

use ReflectionClass;

abstract class AbstractEnums
{
    private array $array;

    public function __construct()
    {
        $class = new ReflectionClass($this);

        $this->array = $class->getConstants();
    }

    public function values(): array
    {
        return array_values($this->array);
    }

    public function all()
    {
        $array = [];
        foreach ($this->array as $key => $value) {
            $array[$value] = $value;
        }

        return $array;
    }
}
