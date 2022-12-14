<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Column extends BaseChart
{
    public function chartInstance()
    {
        return new ColumnChartModel();
    }

    public function build()
    {
        $this->chart
            ->setOpacity($this->opacity())
            ->withOnColumnClickEventName($this->eventName);

        foreach ($this->keys as $index => $key) {
            $this->chart->addColumn($key, $this->values[$index], $this->colorIndex($index));
        }
    }
}
