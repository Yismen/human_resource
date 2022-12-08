<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\LineChartModel;

class Line extends BaseChart
{
    public function chartInstance()
    {
        return new LineChartModel();
    }

    public function constructChart()
    {
        $this->chart
            ->withOnPointClickEvent($this->eventName);

        foreach ($this->data as $index => $project) {
            $this->chart->addPoint($project->name, $project->employees_count, $this->colorIndex($index));
        }
    }
}
