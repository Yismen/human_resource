<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\LineChartModel;

class Line extends BaseChart
{
    public function chartInstance()
    {
        return new LineChartModel();
    }

    public function build()
    {
        $this->chart
            ->withOnPointClickEvent($this->eventName);

        foreach ($this->keys as $index => $key) {
            $this->chart->addPoint($key, $this->values[$index], $this->colorIndex($index));
        }
    }
}
