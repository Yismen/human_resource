<x-human_resource::chart-holder type="primary" :height="$height">
    <livewire:livewire-pie-chart key="{{ $chart->reactiveKey() }}" :pie-chart-model="$chart" />
</x-human_resource::chart-holder>