<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\PieChartModel;

class Pie extends BaseChart
{
    public function chartInstance()
    {
        return new PieChartModel();
    }

    public function constructChart()
    {
        $this->chart
            ->setOpacity($this->opacity())
            ->withOnSliceClickEvent($this->eventName);

        foreach ($this->data as $index => $project) {
            $this->chart->addSlice($project->name, $project->employees_count, $this->colorIndex($index));
        }
    }
}
