<x-human_resource::chart-holder type="primary" :height="$height">
    <livewire:livewire-line-chart key="{{ $chart->reactiveKey() }}" :multiline-chart-model="$chart" />
</x-human_resource::chart-holder>