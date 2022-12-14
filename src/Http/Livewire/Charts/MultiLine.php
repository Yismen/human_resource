<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\LineChartModel;

class MultiLine extends BaseChart
{
    public function chartInstance()
    {
        return new LineChartModel();
    }

    public function build()
    {
        $this->chart
            ->multiLine()
            ->withOnPointClickEvent($this->eventName);

        foreach ($this->keys as $index => $key) {
            $values = $this->values[$index];
            // dd($key, $this->values, $values);
            // dd($values);
            foreach ($values as $value) {
                // $this->chart->addLine($key, $this->values[$index], $this->colorIndex($index));
                $this->chart->addSeriesPoint('sdfasf', 'sdfaf', $value);
            }
        }
    }
}
