<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

interface ChartContract
{
    public function render();

    public function chartInstance();

    public function constructChart();
}
