<?php

namespace Dainsys\HumanResource\Http\Livewire\Charts;

use Livewire\Component;
use Illuminate\Support\Arr;

abstract class BaseChart extends Component implements ChartContract
{
    public $data;
    public string $title = '';
    public string $eventName = 'itemClicked';
    public bool $withDataLabels = true;
    public bool $withLegend = false;
    public bool $withGrid = false;
    protected $chart;
    protected array $colors;
    public string $chart_type;

    public function mount($data)
    {
        $this->data = $data;

        $this->chart = $this->chartInstance();

        $this->colors = $this->colors();

        $this->chart_type = str(get_called_class())->afterLast('\\')->lower();
    }

    public function render()
    {
        return view("human_resource::livewire.charts.{$this->chart_type}", [
            'chart' => $this->createChart(),
        ]);
    }

    protected function createChart()
    {
        $this->constructChart();

        if (strlen($this->title) > 0) {
            $this->chart->setTitle($this->title);
        }

        if ($this->withDataLabels) {
            $this->chart->withDataLabels();
        } else {
            $this->chart->withoutDataLabels();
        }

        if ($this->withLegend) {
            $this->chart->withLegend();
        } else {
            $this->chart->withoutLegend();
        }

        if ($this->withGrid) {
            $this->chart->withGrid();
        }

        return $this->chart;
    }

    protected function colorIndex(int $index)
    {
        return array_key_exists($index, $this->colors) ? $this->colors[$index] : Arr::random($this->colors);
    }

    protected function colors(): array
    {
        return [
            '#3498DB', // prettyriver
            '#8E44AD', // wisteria
            '#16A085', // greensea
            '#C0392B', // pomegranate
            '#2C3E50', // midnightblue
            '#D35400', // pumpkin
            '#1A237E', // indigo
            '#B71C1C', // red
            '#004D40', // teal
            '#E65100', // orange
            '#05C4D3',
            '#E7EB7A',
            '#BC7DFA',
            '#56FE46',
            '#BB59A3',
            '#6F34F9',
            '#905B04',
            '#99325E',
            '#E28AF0',
            '#C714B8',
            '#19FD95',
            '#B58D6E',
            '#457B68',
            '#5913A4',
            '#962941',
            '#745A28',
        ];
    }

    protected function opacity(): float
    {
        return 0.9;
    }
}
