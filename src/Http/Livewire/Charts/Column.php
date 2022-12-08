<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Column extends BaseChart
{
    public function chartInstance()
    {
        return new ColumnChartModel();
    }

    public function constructChart()
    {
        $this->chart
            ->setOpacity($this->opacity())
            ->withOnColumnClickEventName($this->eventName);

        foreach ($this->data as $index => $project) {
            $this->chart->addColumn($project->name, $project->employees_count, $this->colorIndex($index));
        }
    }
}
