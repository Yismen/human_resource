<x-human_resource::chart-holder type="primary" :height="$height">
    <livewire:livewire-column-chart key="{{ $chart->reactiveKey() }}" :multicolumn-chart-model="$chart" />
</x-human_resource::chart-holder>