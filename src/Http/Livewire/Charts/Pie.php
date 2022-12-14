<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\PieChartModel;

class Pie extends BaseChart
{
    public function chartInstance()
    {
        return new PieChartModel();
    }

    public function build()
    {
        $this->chart
            ->setOpacity($this->opacity())
            ->withOnSliceClickEvent($this->eventName);

        foreach ($this->keys as $index => $key) {
            $this->chart->addSlice($key, $this->values[$index], $this->colorIndex($index));
        }
    }
}
