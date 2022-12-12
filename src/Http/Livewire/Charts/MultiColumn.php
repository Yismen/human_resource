<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class MultiColumn extends BaseChart
{
    public function chartInstance()
    {
        return new ColumnChartModel();
    }

    public function build()
    {
        $this->chart
            ->setOpacity($this->opacity())
            ->multiColumn()
            ->withOnColumnClickEventName($this->eventName);

        foreach ($this->keys as $index => $key) {
            $values = $this->values[$index];
            // dd($key, $this->values, $values);
            // dd($values);
            $this->chart->addColumn($key, $this->values[$index], $this->colorIndex($index));
        }
    }
}
